<?php

namespace App\Http\Controllers\back;

use App\Exports\GuruImportTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\GuruImportRequest as ImportValidation;
use App\Imports\guruImport;
use App\Models\Guru;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    private $type;

    /**
     * __construct function.
     */
    public function __construct()
    {
        $this->type = 'guru';
    }
    function addGuru()
    {
        return view('back.pages.add-guru');
    }
    public function storeGuru(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:gurus,name',
                'alamat' => 'required',
                'jenkel' => 'required',
                'tgl_lahir' => 'required',
                'gtk' => 'required',
                'img' => 'required|mimes:jpeg,png,jpg|max:2048',
            ],

            [
                'name.required' => 'Nama lengkap wajib di isi',
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
                $path = "images/guru_images/";
                $file = $request->file('img');
                $filename = $file->getClientOriginalName();
                $new_filename = time() . '' . $filename;
                $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

                $post_thumbnails_path = $path . 'thumbnails';
                if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                    Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
                }

                // create resized image
                Image::make(storage_path('app/public/' . $path . $new_filename))
                    ->fit(315, 315)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

                if ($upload) {
                    $guru = new Guru();
                    $guru->img = $new_filename;
                    $guru->name = $request->name;
                    $guru->alamat = $request->alamat;
                    $guru->jenkel = $request->jenkel;
                    $guru->tgl_lahir = Carbon::parse($request->tgl_lahir);
                    $guru->nip = $request->nip;
                    $guru->gtk = $request->gtk;

                    $saved = $guru->save();
                    if ($saved) {
                        return response()->json(['code'=>1,'msg'=>'New Guru has been successfuly created.']);
                    }else{
                        return response()->json(['code'=>3,'msg'=>'Something went wrong.']);
                    }
                } else {
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong for uploading image.']);
                }
            }
        }
    }

    function updateGuru(Request $request)
    {
        if ($request->hasFile('img')) {

            $path = "images/guru_images/";
            $file = $request->file('img');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '' . $filename;
            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

            $post_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }
            // create resized image
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(315, 315)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

            if ($upload) {

                $old_post_image = Guru::find($request->guru_id)->img;
                if ($old_post_image != null && Storage::disk('public')->exists($path . $old_post_image)) {
                    Storage::disk('public')->delete($path . $old_post_image);
                    if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $old_post_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/resized_' . $old_post_image);
                    }
                }

                $guru = Guru::find($request->guru_id);
                $guru->name = $request->name;
                $guru->jenkel = $request->jenkel;
                $guru->tgl_lahir = Carbon::parse($request->tgl_lahir);
                $guru->nip = $request->nip;
                $guru->gtk = $request->gtk;
                $guru->alamat = $request->alamat;
                $guru->img = $new_filename;
                $saved = $guru->save();

                if ($saved) {
                    return response()->json(['code' => 1, 'msg' => 'Guru successfuly Updated.']);
                } else {
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating post.']);
                }
            } else {
                return response()->json(['code' => 3, 'msg' => 'Error in uploading image.']);
            }
        } else {
            $guru = Guru::find($request->guru_id);
            $guru->name = $request->name;
            $guru->jenkel = $request->jenkel;
            $guru->tgl_lahir = Carbon::parse($request->tgl_lahir);
            $guru->nip = $request->nip;
            $guru->gtk = $request->gtk;
            $guru->alamat = $request->alamat;
            $saved = $guru->save();
            if ($saved) {
                return response()->json(['code' => 1, 'msg' => 'Guru has been successfuly updated.']);
            } else {
                return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating post.']);
            }
        }
    }
    function editGuru(Request $request)
    {
        if (!request()->guru_id) {
            return abort(404);
        } else {
            $guru = Guru::find(request()->guru_id);
            $data = [
                'guru' => $guru,
                'pageTitle' => 'Edit Guru',
            ];
            return view('back.pages.edit-guru', $data);
        }
    }
    public function exportPDF()
    {
        $gurus = Guru::all();
        $pdf = Pdf::loadView('livewire.back.export.guruexport-pdf', ['gurus' => $gurus]);
        return $pdf->download('guru' . rand(1, 1000) . '.pdf');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required',
        ]);

        Excel::import(new guruImport, request()->file('import_file'));

        return back()->withStatus('Import done!');
    }

    public function importTemplateGuru() {
        return new GuruImportTemplate($this->type);
    }

    public function importGuru(ImportValidation $request)
    {
        try {
            if ($request->ajax()) {
                $request->validated();

                Excel::import(new guruImport(), $request->file('file'));

                return response()->json(['success' => 'update success']);
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }

    }
}
