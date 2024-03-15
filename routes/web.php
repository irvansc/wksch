<?php

use App\Http\Controllers\front\ArticleController;
use App\Http\Controllers\front\EventController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\PengumumanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::view('/','front.pages.home')->name('home');
Route::view('/identitas-sekolah', 'front.pages.identitas')->name('identitas-sekolah');
Route::view('/sejarah-sekolah', 'front.pages.sejarah')->name('sejarah-sekolah');
Route::view('/visi-misi', 'front.pages.visimisi')->name('visi-misi');
Route::view('/peta-sekolah', 'front.pages.petasekolah')->name('peta-sekolah');
Route::view('/sarana-sekolah', 'front.pages.saranasekolah')->name('sarana-sekolah');
Route::view('/ekstrakulikuler', 'front.pages.ekstrakulikuler')->name('ekstrakulikuler');
Route::view('/prestasi-sekolah', 'front.pages.prestasisekolah')->name('prestasi-sekolah');

// ARTICLE
Route::view('/article', 'front.pages.article.home')->name('article');
Route::get('/article/{any}',[ArticleController::class,'readPost'])->name('read_post');
Route::get('/category/{any}',[ArticleController::class,'categoryPost'])->name('category_post');
Route::get('/tag/{any}',[ArticleController::class,'tagPost'])->name('tag_post');
Route::get('/search',[ArticleController::class,'searchBlog'])->name('search_post');

Route::view('/pengumuman', 'front.pages.pengumuman')->name('pengumuman');
Route::get('/pengumuman/{any}',[PengumumanController::class,'readPengumuman'])->name('read_announcement');
Route::view('/agenda', 'front.pages.agenda')->name('agenda');
Route::get('events/lis', [EventController::class, 'listEvent'])->name('events.lis');
Route::resource('events', EventController::class);
Route::get('folders/{filename}/download', [HomeController::class, 'download'])->name('folders.downloads');
// ALUMNI

Route::view('/alumni-form', 'front.pages.alumni-form')->name('alumni-form');
Route::view('/alumni', 'front.pages.alumni')->name('alumni');
Route::view('/guru', 'front.pages.guru')->name('guru');
Route::view('/siswa', 'front.pages.siswa')->name('siswa');
Route::view('/foto', 'front.pages.foto')->name('foto');
Route::view('/video', 'front.pages.video')->name('video');
Route::view('/contact', 'front.pages.contact')->name('contact');
Route::view('/about', 'front.pages.about')->name('about');
route::view('/download','front.pages.download')->name('download');

