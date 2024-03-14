<?php

namespace App\Http\Controllers\back;
use App\Http\Controllers\Controller;
use App\Models\KepalaSekolah;
use App\Models\LogoSekolah;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class AdminController extends Controller
{


    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }
    public function ResetForm(Request $request, $token = null)
    {
        $data = [
            'pageTitle' => 'Reset Password'
        ];
        return view('back.pages.auth.reset', $data)->with(['token' => $token, 'email' => $request->email]);
    }

    public function changeProfilePicture(Request $request)
    {
        $user = User::find(auth('web')->id());
        $path = 'back/dist/img/admins/';
        $file = $request->file('file');
        $old_picture = $user->getAttributes()['picture'];
        $file_path = $path . $old_picture;
        $new_picture_name = 'AIMG' . $user->id . time() . rand(1, 100000) . '.jpg';

        if ($old_picture != null && File::exists(public_path($file_path))) {
            File::delete(public_path($file_path));
        }
        $upload = $file->move(public_path($path), $new_picture_name);
        if ($upload) {
            $user->update([
                'picture' => $new_picture_name
            ]);
            return response()->json(['status' => 1, 'msg' => 'Your profile picture has been successfully updated.']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }
    }

    public function changeBlogLogo(Request $request)
    {
        $setting = LogoSekolah::find(1);
        $logo_path = 'back/dist/img/logo-favicon/';
        $old_logo = $setting->getAttributes()['logo_utama'];
        $file = $request->file('logo_utama');
        $filename = rand(1, 100000) . 'logo.png';
        if ($request->hasFile('logo_utama')) {
            if ($old_logo != null  && File::exists(public_path($logo_path . $old_logo))) {
                File::delete(public_path($logo_path . $old_logo));
            }
            $upload = $file->move(public_path($logo_path), $filename);
            if ($upload) {
                $setting->update([
                    'logo_utama' => $filename
                ]);
                return response()->json(['status' => 1, 'msg' => 'Logo has been successfuly updated.']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something wrong!']);
            }
        }
    }

    public function changeBlogFavicon(Request $request)
    {
        $setting = LogoSekolah::find(1);
        $favicon_path = 'back/dist/img/logo-favicon/';
        $old_favicon = $setting->getAttributes()['logo_favicon'];
        $file = $request->file('logo_favicon');
        $filename = rand(1, 100000) . 'favicon.ico';
        if ($request->hasFile('logo_favicon')) {
            if ($old_favicon != null  && File::exists(public_path($favicon_path . $old_favicon))) {
                File::delete(public_path($favicon_path . $old_favicon));
            }
            $upload = $file->move(public_path($favicon_path), $filename);
            if ($upload) {
                $setting->update([
                    'logo_favicon' => $filename
                ]);
                return response()->json(['status' => 1, 'msg' => 'Larablog has been successfuly updated.']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something wrong!']);
            }
        }
    }

    public function createPost(Request $request)
    {


        $request->validate([
            'post_title' => 'required|unique:posts,post_title',
            'post_content' => 'required',
            'post_category' => 'required|exists:sub_categories,id',
            'featured_image' => 'required|mimes:jpeg,png,jpg|max:1024'
        ]);

        if ($request->hasFile('featured_image')) {
            $path = "images/post_images/";
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '' . $filename;
            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

            $post_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }
            // create square thumbnails
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(200, 200)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));
            // create resized image
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(500, 350)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

            if ($upload) {
                $post = new Post();
                $post->author_id = auth()->id();
                $post->category_id = $request->post_category;
                $post->post_title = $request->post_title;
                // $post->slug = Str::slug($request->post_title);
                $post->post_content = $request->post_content;
                $post->featured_image = $new_filename;
                $post->post_tags = $request->post_tags;
                $post->isActive = $request->isActive;
                $post->meta_desc = $request->meta_desc;
                $post->meta_keywords = $request->meta_keywords;
                $saved = $post->save();
                if ($saved) {
                    return response()->json(['code' => 1, 'msg' => 'New Post has been successfuly created.']);
                } else {
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong!']);
                }
            } else {
                return response()->json(['code' => 3, 'msg' => 'Something went wrong for uploading image.']);
            }
        }
    }

    public function editPost(Request $request)
    {
        if (!request()->post_id) {
            return abort(404);
        } else {
            $post = Post::find(request()->post_id);
            $data = [
                'post' => $post,
                'pageTitle' => 'Edit Post',
            ];
            return view('back.pages.edit_post', $data);
        }
    }

    public function updatePost(Request $request)
    {
        if ($request->hasFile('featured_image')) {

            $request->validate([
                'post_title' => 'required|unique:posts,post_title,' . $request->post_id,
                'post_content' => 'required',
                'post_category' => 'required|exists:sub_categories,id',
                'featured_image' => 'required|mimes:jpeg,png,jpg|max:1024'
            ]);

            $path = "images/post_images/";
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '' . $filename;
            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

            $post_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }
            // create square thumbnails
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(200, 200)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));
            // create resized image
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(500, 350)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

            if ($upload) {

                $old_post_image = Post::find($request->post_id)->featured_image;
                if ($old_post_image != null && Storage::disk('public')->exists($path . $old_post_image)) {
                    Storage::disk('public')->delete($path . $old_post_image);
                    if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $old_post_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/resized_' . $old_post_image);
                    }
                    if (Storage::disk('public')->exists($path . 'thumbnails/thumb_' . $old_post_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/thumb_' . $old_post_image);
                    }
                }

                $post = Post::find($request->post_id);
                $post->category_id = $request->post_category;
                $post->slug = null;
                $post->post_content = $request->post_content;
                $post->post_title = $request->post_title;
                $post->post_tags = $request->post_tags;
                $post->featured_image = $new_filename;
                $post->isActive = $request->isActive;
                $post->meta_desc = $request->meta_desc;
                $post->meta_keywords = $request->meta_keywords;
                $saved = $post->save();

                if ($saved) {
                    return response()->json(['code' => 1, 'msg' => 'Post has been successfuly updated.']);
                } else {
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating post.']);
                }
            } else {
                return response()->json(['code' => 3, 'msg' => 'Error in uploading image.']);
            }
        } else {
            $request->validate([
                'post_title' => 'required|unique:posts,post_title,' . $request->post_id,
                'post_content' => 'required',
                'post_category' => 'required|exists:sub_categories,id'
            ]);

            $post = Post::find($request->post_id);
            $post->category_id = $request->post_category;
            $post->slug = null;
            $post->post_content = $request->post_content;
            $post->post_title = $request->post_title;
            $post->post_tags = $request->post_tags;
            $post->isActive = $request->isActive;
            $post->meta_desc = $request->meta_desc;
            $post->meta_keywords = $request->meta_keywords;
            $saved = $post->save();
            if ($saved) {
                return response()->json(['code' => 1, 'msg' => 'Post has been successfuly updated.']);
            } else {
                return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating post.']);
            }
        }
    }
    public function contentImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
            $request->file('upload')->storeAs('public/uploads/thumbnail', $filenametostore);

            //Resize image here
            $thumbnailpath = public_path('storage/uploads/thumbnail/' . $filenametostore);
            $img = Image::make($thumbnailpath)->resize(500, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            echo json_encode([
                'default' => asset('storage/uploads/' . $filenametostore),
                '500' => asset('storage/uploads/thumbnail/' . $filenametostore)
            ]);
        }
    }

    public function changeProfilePictureKepsek(Request $request)
    {
        $user = KepalaSekolah::find(1);
        $path = 'back/dist/img/kepala/';
        $file = $request->file('img');
        $old_picture = $user->getAttributes()['img'];
        $file_path = $path . $old_picture;
        $new_picture_name = 'KEP' . $user->id . time() . rand(1, 100000) . '.jpg';

        if ($old_picture != null && File::exists(public_path($file_path))) {
            File::delete(public_path($file_path));
        }
        $upload = $file->move(public_path($path), $new_picture_name);
        if ($upload) {
            $user->update([
                'img' => $new_picture_name
            ]);
            return response()->json(['status' => 1, 'msg' => 'Your picture has been successfully updated.']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }
    }
}
