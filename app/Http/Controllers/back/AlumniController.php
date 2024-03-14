<?php

namespace App\Http\Controllers\back;

use App\Exports\AlumniImportTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportValidation;
use App\Imports\AlumniImport;
use App\Models\Alumni;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image as Image;
class AlumniController extends Controller
{
    private $type;

    /**
     * __construct function.
     */
    public function __construct()
    {
        $this->type = 'admin';
    }
    public function show(Request $request)
    {
        $id = $request->id;
        $alumni = Alumni::find($id);
        return response()->json($alumni);
    }

    function addAlumni()
    {
        return view('back.pages.add-alumni');
    }
    public function storeAlumni(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:alumnis,name',
                'alamat' => 'required',
                'jenkel' => 'required',
                'thn_lulus' => 'required|numeric',
                'thn_masuk' => 'required|numeric',
                'tgl_lahir' => 'required',
                'nis' => 'required|numeric',
                'email' => 'required|email',
                'telp' => 'required|min:10|numeric',
                'img' => 'required|mimes:jpeg,png,jpg|max:2048',
            ],

            [
                'name.required' => 'Nama lengkap wajib di isi',
                'name.unique' => 'Nama lengkap sudah terdaftar',
                'alamat.required' => 'Alamat wajib di isi',
                'jenkel.required' => 'Jenis kelamin wajib di pilih',
                'thn_lulus.required' => 'Tahun lulus wajib diisi',
                'thn_masuk.required' => 'Tahun masuk wajib diisi',
                'tgl_lahir.required' => 'Tanggal lahir wajib diisi',
                'email.required' => 'E-mail wajib diisi',
                'telp.required' => 'WhatsAap/Telp wajib diisi',
                'nis.required' => 'NIS wajib diisi',
                'img.mimes' => 'Gambar harus extensi JPG.JPEG,PNG',
                'img.required' => 'Gambar wajib di isi',
                'img.max' => 'Gambar maksimal 2MB'

            ]
        );
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            if ($request->hasFile('img')) {
                $path = "images/alumni_images/";
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
                    $alumni = new Alumni();
                    $alumni->img = $new_filename;
                    $alumni->name = $request->name;
                    $alumni->alamat = $request->alamat;
                    $alumni->jenkel = $request->jenkel;
                    $alumni->tgl_lahir = Carbon::parse( $request->tgl_lahir);
                    $alumni->thn_lulus = $request->thn_lulus;
                    $alumni->thn_masuk = $request->thn_masuk;
                    $alumni->nis = $request->nis;
                    $alumni->email = $request->email;
                    $alumni->telp = $request->telp;

                    $saved = $alumni->save();
                    if ($saved) {
                        return response()->json(['code' => 1, 'msg' => 'New Alumni has been successfuly created.']);
                    } else {
                        return response()->json(['code' => 3, 'msg' => 'Something went wrong.']);
                    }
                } else {
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong for uploading image.']);
                }
            }
        }
    }

    function updateAlumni(Request $request)
    {
        if ($request->hasFile('img')) {

            $path = "images/alumni_images/";
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

                $old_post_image = Alumni::find($request->alumni_id)->img;
                if ($old_post_image != null && Storage::disk('public')->exists($path . $old_post_image)) {
                    Storage::disk('public')->delete($path . $old_post_image);
                    if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $old_post_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/resized_' . $old_post_image);
                    }
                }

                $alumni = Alumni::find($request->alumni_id);
                $alumni->name = $request->name;
                $alumni->jenkel = $request->jenkel;
                $alumni->thn_lulus = $request->thn_lulus;
                $alumni->tgl_lahir = $request->tgl_lahir;
                $alumni->nis = $request->nis;
                $alumni->email = $request->email;
                $alumni->telp = $request->telp;
                $alumni->alamat = $request->alamat;
                $alumni->img = $new_filename;
                $saved = $alumni->save();

                if ($saved) {
                    return response()->json(['code' => 1, 'msg' => 'Alumni successfuly Updated.']);
                } else {
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating post.']);
                }
            } else {
                return response()->json(['code' => 3, 'msg' => 'Error in uploading image.']);
            }
        } else {
            $alumni = Alumni::find($request->alumni_id);
            $alumni->name = $request->name;
            $alumni->jenkel = $request->jenkel;
            $alumni->thn_lulus = $request->thn_lulus;
            $alumni->tgl_lahir = Carbon::parse( $request->tgl_lahir);
            $alumni->nis = $request->nis;
            $alumni->email = $request->email;
            $alumni->telp = $request->telp;
            $alumni->alamat = $request->alamat;
            $saved = $alumni->save();
            if ($saved) {
                return response()->json(['code' => 1, 'msg' => 'Alumni has been successfuly updated.']);
            } else {
                return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating post.']);
            }
        }
    }
    function editAlumni(Request $request)
    {
        if (!request()->alumni_id) {
            return abort(404);
        } else {
            $alumni = Alumni::find(request()->alumni_id);
            $data = [
                'alumni' => $alumni,
                'pageTitle' => 'Edit Alumni',
            ];
            return view('back.pages.edit-alumni', $data);
        }
    }
    public function exportPDF()
    {
        $alumnis = Alumni::all();
        $pdf = Pdf::loadView('livewire.back.export.alumniexport-pdf', ['alumnis' => $alumnis]);
        return $pdf->download('user' . rand(1, 1000) . '.pdf');
    }
    public function importTemplate()
    {
        return new AlumniImportTemplate($this->type);
    }

    public function importAlumni(ImportValidation $request)
    {
        try {
            if ($request->ajax()) {
                $request->validated();

                Excel::import(new AlumniImport(), $request->file('file'));

                return response()->json(['success' => 'update success']);
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }

    }
}
