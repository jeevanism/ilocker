<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;

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

Route::get('/',[App\Http\Controllers\GalleryController::class,'show'])->name('gallery');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// upload image POST
Route::post('/home', [ App\Http\Controllers\ImageUploadController::class, 'store' ])->name('upload');

Route::get('/ajaxupdate/{id}', [App\Http\Controllers\GalleryController::class,'ajaxPersonalLocker'])
			->name('getajaxupdate');

//UPDATE visibility via AJAX			
Route::post('/ajaxupdate',[App\Http\Controllers\GalleryController::class,'ajaxPersonalLockerUpdate'])
		->name('ajaxupdate');

//Delete image via AJAX		
Route::post('/ajaxDelete',[App\Http\Controllers\GalleryController::class,'ajaxDelete'])
		->name('ajaxDelete');


