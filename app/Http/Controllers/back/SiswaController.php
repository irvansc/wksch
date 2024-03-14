<?php

namespace App\Http\Controllers\back;

use App\Exports\SiswaImportTemplate;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;
use App\Http\Requests\SiswaImportRequest as ImportValidation;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    private $type;

    /**
     * __construct function.
     */
    public function __construct()
    {
        $this->type = 'siswa';
    }
    public function show(Request $request)
    {
        $id = $request->id;
        $siswa = Siswa::find($id);
        return response()->json($siswa);
    }

    function addSiswa()
    {
        return view('back.pages.add-siswa');
    }
    public function storeSiswa(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kelas_id' => 'required',
                'name' => 'required|unique:siswas,name',
                'alamat' => 'required',
                'jenkel' => 'required',
                'tgl_lahir' => 'required',
                'nis' => 'required',
                'img' => 'required|mimes:jpeg,png,jpg|max:2048',
            ],

            [
                'name.required' => 'Nama lengkap wajib di isi',
                'nis.required' => 'NIS wajib di isi',
                'kelas_id.required' => 'Kelas wajib di isi',
                'name.unique' => 'Nama lengkap Guru sudah terdaftar',
                'alamat.required' => 'Alamat wajib di isi',
                'jenkel.required' => 'Jenis kelamin wajib di pilih',
                'tgl_lahir.required' => 'Tanggal lahir wajib diisi',
                'img.mimes' => 'Gambar harus extensi JPG.JPEG,PNG',
                'img.required' => 'Gambar wajib di isi',
                'img.max' => 'Gambar maksimal 2MB'

            ]
        );
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            if ($request->hasFile('img')) {
                $path = "images/siswa_images/";
                $file = $request->file('img');
                $filename = $file->getClientOriginalName();
                $new_filename = time() . '' . $filename;
                $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

                $siswa_thumbnails_path = $path . 'thumbnails';
                if (!Storage::disk('public')->exists($siswa_thumbnails_path)) {
                    Storage::disk('public')->makeDirectory($siswa_thumbnails_path, 0755, true, true);
                }

                // create resized image
                Image::make(storage_path('app/public/' . $path . $new_filename))
                    ->fit(315, 315)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

                if ($upload) {
                    $siswa = new Siswa();
                    $siswa->img = $new_filename;
                    $siswa->name = $request->name;
                    $siswa->alamat = $request->alamat;
                    $siswa->jenkel = $request->jenkel;
                    $siswa->tgl_lahir = Carbon::parse( $request->tgl_lahir);
                    $siswa->nis = $request->nis;
                    $siswa->kelas_id = $request->kelas_id;

                    $saved = $siswa->save();
                    if ($saved) {
                        return response()->json(['code'=>1,'msg'=>'New Siswa has been successfuly created.']);
                    }else{
                        return response()->json(['code'=>3,'msg'=>'Something went wrong.']);
                    }
                } else {
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong for uploading image.']);
                }
            }
        }
    }

    function updateSiswa(Request $request)
    {
        if ($request->hasFile('img')) {

            $path = "images/siswa_images/";
            $file = $request->file('img');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '' . $filename;
            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

            $siswa_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($siswa_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($siswa_thumbnails_path, 0755, true, true);
            }
            // create resized image
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(315, 315)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

            if ($upload) {

                $old_siswa_image = Siswa::find($request->siswa_id)->img;
                if ($old_siswa_image != null && Storage::disk('public')->exists($path . $old_siswa_image)) {
                    Storage::disk('public')->delete($path . $old_siswa_image);
                    if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $old_siswa_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/resized_' . $old_siswa_image);
                    }
                }

                $siswa = Siswa::find($request->siswa_id);
                $siswa->kelas_id = $request->kelas_id;
                $siswa->name = $request->name;
                $siswa->jenkel = $request->jenkel;
                $siswa->tgl_lahir = Carbon::parse($request->tgl_lahir);
                $siswa->nis = $request->nis;
                $siswa->alamat = $request->alamat;
                $siswa->img = $new_filename;
                $saved = $siswa->save();

                if ($saved) {
                    return response()->json(['code' => 1, 'msg' => 'Siswa successfuly Updated.']);
                } else {
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating siswa.']);
                }
            } else {
                return response()->json(['code' => 3, 'msg' => 'Error in uploading image.']);
            }
        } else {
            $siswa = Siswa::find($request->siswa_id);
            $siswa->name = $request->name;
            $siswa->jenkel = $request->jenkel;
            $siswa->tgl_lahir = Carbon::parse($request->tgl_lahir);
            $siswa->nis = $request->nis;
            $siswa->kelas_id = $request->kelas_id;
            $siswa->alamat = $request->alamat;
            $saved = $siswa->save();
            if ($saved) {
                return response()->json(['code' => 1, 'msg' => 'siswa has been successfuly updated.']);
            } else {
                return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating siswa.']);
            }
        }
    }
    function editSiswa(Request $request)
    {
        if (!request()->siswa_id) {
            return abort(404);
        } else {
            $siswa = Siswa::find(request()->siswa_id);
            $data = [
                'siswa' => $siswa,
                'pageTitle' => 'Edit Siswa',
            ];
            return view('back.pages.edit-siswa', $data);
        }
    }
    public function exportPDF()
    {
        $siswa = Siswa::with('kelas')->get();
        $pdf = Pdf::loadView('livewire.back.export.siswa-export-pdf', ['siswa' => $siswa]);
        return $pdf->download('guru' . rand(1, 1000) . '.pdf');
    }


    public function importTemplateSiswa() {
        return new SiswaImportTemplate($this->type);
    }

    public function importSiswa(ImportValidation $request)
    {
        try {
            if ($request->ajax()) {
                $request->validated();

                Excel::import(new SiswaImport(), $request->file('file'));

                return response()->json(['success' => 'update success']);
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }

    }
}
