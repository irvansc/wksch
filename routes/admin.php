<?php


use App\Http\Controllers\back\AdminController;
use App\Http\Controllers\back\AlumniController;
use App\Http\Controllers\back\DeleteTemporaryDocumentController;
use App\Http\Controllers\back\EventController;
use App\Http\Controllers\back\FileController;
use App\Http\Controllers\back\FotoController;
use App\Http\Controllers\back\GuruController;
use App\Http\Controllers\back\HomeController;
use App\Http\Controllers\back\PengumumanController;
use App\Http\Controllers\back\PetaSekolahController;
use App\Http\Controllers\back\SaranaController;
use App\Http\Controllers\back\SejarahController;
use App\Http\Controllers\back\SiswaController;
use App\Http\Controllers\back\StoreDocumentController;
use App\Http\Controllers\back\UploadTemporaryDocumentController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:web'])->group(function () {
        Route::view('/login', 'back.pages.auth.login')->name('login');
        Route::view('/forgot-password', 'back.pages.auth.forgot')->name('forgot-password');
        Route::get('/password/reset/{token}', [AdminController::class, 'ResetForm'])->name('reset-form');
    });

    Route::middleware(['auth:web'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        Route::view('/profile', 'back.pages.profile')->name('profile');
        Route::post('/change-profile-picture', [AdminController::class, 'changeProfilePicture'])->name('change-profile-picture');
        Route::post('/change-profile-picture-kepsek', [AdminController::class, 'changeProfilePictureKepsek'])->name('change-profile-picture-kepsek');
        Route::middleware(['isAdmin'])->group(function(){
            Route::view('/settings', 'back.pages.settings')->name('settings');
            Route::post('/change-blog-logo', [AdminController::class, 'changeBlogLogo'])->name('change-blog-logo');
            Route::post('/change-blog-favicon', [AdminController::class, 'changeBlogFavicon'])->name('change-blog-favicon');
            Route::view('/admins', 'back.pages.admins')->name('admins');

            // IDENTITAS SEKOLAH
            Route::view('identitas', 'back.pages.identitas')->name('identitas');
            // SEJARAH
            Route::get('sejarah', [SejarahController::class, 'index'])->name('sejarah');
            Route::get('edit-sejarah', [SejarahController::class, 'editSejarah'])->name('edit-sejarah');
            Route::post('update-sejarah', [SejarahController::class, 'updateSejarah'])->name('update-sejarah');
            // VISI/MISI
            Route::view('vm', 'back.pages.vm')->name('vm');

            // PETA SEKOLAH
            Route::get('peta-sekolah', [PetaSekolahController::class, 'index'])->name('peta-sekolah');
            Route::get('edit-peta', [PetaSekolahController::class, 'editPeta'])->name('edit-peta');
            Route::post('update-peta', [PetaSekolahController::class, 'updatePeta'])->name('update-peta');
            // SARANA SEKOLAH
            Route::get('sarana', [SaranaController::class, 'index'])->name('sarana');
            Route::get('edit-sarana', [SaranaController::class, 'editSarana'])->name('edit-sarana');
            Route::post('update-sarana', [SaranaController::class, 'updateSarana'])->name('update-sarana');
            // ekstrakulikuler
            Route::view('ekstrakulikuler', 'back.pages.ekstrakulikuler')->name('ekstrakulikuler');
            Route::view('ekstrakulikuler-list', 'back.pages.ekstrakulikuler-list')->name('ekstrakulikuler-list');
            // prestasi
            Route::view('prestasi', 'back.pages.prestasi')->name('prestasi');
            Route::view('prestasi-list', 'back.pages.prestasi-list')->name('prestasi-list');
            // PENGUMUMAN SEKOLAH
            Route::view('pengumuman', 'back.pages.pengumuman')->name('pengumuman');
            Route::get('/edit-pengumuman', [PengumumanController::class, 'editPengumuman'])->name('edit-pengumuman');
            Route::view('/add-pengumuman', 'back.pages.add-pengumuman')->name('add-pengumuman');
            Route::post('/create-pengumuman', [PengumumanController::class, 'createPengumunan'])->name('create-pengumuman');
            Route::post('/update-pengumuman', [PengumumanController::class, 'updatePengumuman'])->name('update-pengumuman');

            // AGENDA
            Route::view('agenda', 'back.pages.agenda')->name('agenda');

            // DIREKTORI ALUMNI
            Route::view('alumni', 'back.pages.alumni')->name('alumni');
            Route::post('/store-alumni', [AlumniController::class, 'storeAlumni'])->name('store-alumni');
            Route::get('/add-alumni', [AlumniController::class, 'addAlumni'])->name('add-alumni');
            Route::get('/edit-alumni', [AlumniController::class, 'editAlumni'])->name('edit-alumni');
            Route::post('/update-alumni', [AlumniController::class, 'updateAlumni'])->name('update-alumni');
            Route::get('/alumniexport-pdf', [AlumniController::class, 'exportPDF'])->name('alumniexport-pdf');
            Route::view('/importForm', 'back.pages.importForm')->name('importForm');
            Route::post('import-alumni', [AlumniController::class, 'importAlumni'])->name('import-alumni');
            Route::get('import-template', [AlumniController::class, 'importTemplate'])->name('import.template');
            // DIREKTORI GURU
            Route::view('guru', 'back.pages.guru')->name('guru');
            Route::post('/store-guru', [GuruController::class, 'storeGuru'])->name('store-guru');
            Route::get('/add-guru', [GuruController::class, 'addGuru'])->name('add-guru');
            Route::get('/edit-guru', [GuruController::class, 'editGuru'])->name('edit-guru');
            Route::post('/update-guru', [GuruController::class, 'updateGuru'])->name('update-guru');
            Route::get('/guruexport-pdf', [GuruController::class, 'exportPDF'])->name('guruexport-pdf');
            Route::view('/import-formguru', 'back.pages.importform-guru')->name('import-formguru');
            Route::post('import-guru', [GuruController::class, 'importGuru'])->name('import-guru');
            Route::get('import-templateguru', [GuruController::class, 'importTemplateGuru'])->name('import-templateguru');
            // SISWA
            Route::view('kelas', 'back.pages.kelas')->name('kelas');
            Route::view('siswa-list', 'back.pages.siswa-list')->name('siswa-list');
            Route::post('/store-siswa', [SiswaController::class, 'storeSiswa'])->name('store-siswa');
            Route::get('/add-siswa', [SiswaController::class, 'addSiswa'])->name('add-siswa');
            Route::get('/edit-siswa', [SiswaController::class, 'editSiswa'])->name('edit-siswa');
            Route::post('/update-siswa', [SiswaController::class, 'updateSiswa'])->name('update-siswa');
            Route::get('/siswaexport-pdf', [SiswaController::class, 'exportPDF'])->name('siswaexport-pdf');
            Route::view('/import-formsiswa', 'back.pages.importform-siswa')->name('import-formsiswa');
            Route::post('import-siswa', [SiswaController::class, 'importSiswa'])->name('import-siswa');
            Route::get('import-templatesiswa', [SiswaController::class, 'importTemplateSiswa'])->name('import-templatesiswa');
            // ALBUM
            Route::view('album-foto', 'back.pages.album')->name('album-foto');
            // FOTO
            Route::view('foto-list', 'back.pages.foto')->name('foto-list');
            Route::get('add-foto', [FotoController::class,'index'])->name('add-foto');
            Route::post('store-foto', [FotoController::class,'StoreFoto'])->name('store-foto');
            Route::get('/edit/foto/{id}',[FotoController::class,'editFoto'])->name('edit-foto');
            // Route::get('/add-foto', [FotoController::class, 'addFoto'])->name('add-foto');

            // VIDEO
            Route::view('video-list', 'back.pages.video')->name('video-list');

            // KEPSEK
            Route::view('kepsek', 'back.pages.kepsek')->name('kepsek');
            // FILE
            Route::view('folders', 'back.pages.folders')->name('folders');
            // Folder
            Route::get('add-folder', [FileController::class, 'addFolder'])->name('add-folder');
            Route::post('store-folder', [FileController::class, 'storeFolder'])->name('store-folder');
            Route::get('folders/{filename}/download', [FileController::class, 'download'])->name('folders.download');
            Route::get('/edit-folder', [FileController::class, 'editFolder'])->name('edit-folder');
            Route::post('/update-folder', [FileController::class, 'updateFolder'])->name('update-folder');
            // SLIDER UTAMA
            Route::view('slider-utama', 'back.pages.sliderUtama')->name('slider-utama');

            // SLIDER PRESTASI
            Route::view('slider-prestasi', 'back.pages.sliderPrestasi')->name('slider-prestasi');
            // SLIDER alumni
            Route::view('slider-alumni', 'back.pages.sliderAlumni')->name('slider-alumni');
            // INBOX
            Route::view('inbox', 'back.pages.inbox')->name('inbox');

            Route::get('events/list', [EventController::class, 'listEvent'])->name('events.list');
            Route::resource('events', EventController::class);
        });



        Route::prefix('posts')
                ->name('posts.')
                ->group(function () {
                    Route::middleware(['isPublish'])->group(function () {
                        Route::view('/add-post', 'back.pages.add-post')->name('add-post');
                        Route::post('/create', [AdminController::class, 'createPost'])->name('create');
                        Route::view('/all-post', 'back.pages.all_posts')->name('all_posts');
                        Route::get('/edit-posts', [AdminController::class, 'editPost'])->name('edit-posts');
                        Route::post('/update-post', [AdminController::class, 'updatePost'])->name('update-post');
                        Route::post('/post-upload', [AdminController::class, 'contentImage'])->name('post-upload');
                        Route::view('/categories', 'back.pages.categories')->name('categories');
                    });
                });
    });
});
