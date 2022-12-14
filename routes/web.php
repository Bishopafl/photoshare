<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/' , [FrontEndController::class, 'index']);

Route::get('/profile', [FollowController::class, 'profile'])->name('profile');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/follow', [FollowController::class, 'followUnfollow']);
Route::get('/user/profile/{id}', [FrontEndController::class, 'userAlbum'])->name('user.album');

Route::get('/albums/{slug}/{id}', [GalleryController::class, 'viewAlbum'])->name('view.album');

Route::get('/getalbums', [AlbumController::class, 'getAlbums'])->middleware('auth');

Route::get('/getimages', [GalleryController::class, 'images'])->middleware('auth');

Route::delete('/image/{id}', [GalleryController::class, 'destroy'])->middleware('auth');

Route::get('/albums/create', [AlbumController::class, 'create'])->name('album.create')->middleware('auth');

Route::get('/albums', [AlbumController::class, 'index'])->middleware('auth');
Route::post('/albums/store', [AlbumController::class, 'store'])->middleware('auth');
Route::put('albums/{id}/edit', [AlbumController::class, 'update'])->middleware('auth');
Route::delete('/albums/{id}/delete', [AlbumController::class, 'destroy'])->middleware('auth');

Route::get('/upload/images/{id}', [GalleryController::class, 'create'])->middleware('auth');
Route::post('/uploadImage', [GalleryController::class, 'upload'])->middleware('auth');