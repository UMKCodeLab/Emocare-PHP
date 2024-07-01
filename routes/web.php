<?php

// use App\Http\Controllers\LoginController;
// use App\Http\Controllers\RegisterController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\KomentarController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth account
Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('/login-proses',[AuthController::class,'authenticate'])->name('login.proses');
Route::get('/register',[AuthController::class,'reg'])->name('register');
Route::post('/register-proses',[AuthController::class,'create'])->name('register.proses');
Route::get('/register/biodata',[AuthController::class,'bioData'])->name('biodata');
Route::post('/register/biodata-proses',[AuthController::class,'createBio'])->name('biodata.proses');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

// edit akun
Route::get('/profile-settings/{id}',[AuthController::class,'profile_setting'])->name('setting_profile')->middleware('auth');
Route::post('/edit-profile/{id}',[AuthController::class,'edit_profile'])->name('edit_profile')->middleware('auth');

// Main Content / Post(Forum)
Route::get('/',[ForumController::class,'index'])->name('forum')->middleware('auth');
Route::post('/upload-post',[ForumController::class,'create'])->name('upload')->middleware('auth');
Route::get('/edit-post/{id}', [ForumController::class, 'edit_forum'])->name('forum.edit')->middleware('auth');
Route::put('/update-post/{id}',[ForumController::class, 'update_forum'])->name('forum.update')->middleware('auth');
Route::delete('/delete-post/{id}', [ForumController::class, 'delete_forum'])->name('forum.delete')->middleware('auth');
Route::delete('/delete-comment/{id}', [ForumController::class, 'delete_comment'])->name('comment.delete')->middleware('auth');

Route::get('/post/{id}',[ForumController::class,'komentar'])->name('komentar')->middleware('auth');
Route::post('/upload-komen',[ForumController::class,'komentar_proses'])->name('komentar-proses')->middleware('auth');

Route::get('/profile',[ForumController::class,'profile'])->name('profile')->middleware('auth');
Route::post('/upload-post-profile',[ForumController::class,'upload_profile'])->name('posting')->middleware('auth');

// aspirasi
Route::get('/ruangaspirasi',[AspirasiController::class,'index'])->name('aspirasi')->middleware('auth');
Route::get('/upload-aspirasi',[AspirasiController::class,'create'])->name('create.content')->middleware('auth');
Route::post('/upload-aspirasi-proses',[AspirasiController::class,'store'])->name('store.content')->middleware('auth');
Route::get('/content-aspirasi/{id}',[AspirasiController::class,'show'])->name('content.show')->middleware('auth');

// Admin
Route::get('/admin',[AdminController::class,'index'])->name('admin')->middleware('admin');
Route::post('/report-post',[AdminController::class,'create_report'])->name('proses.report')->middleware('auth');

Route::get('/report',[AdminController::class,'show'])->name('report')->middleware('admin');

