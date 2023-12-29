<?php

// use App\Http\Controllers\LoginController;
// use App\Http\Controllers\RegisterController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
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


// Main Content

Route::get('/',[ForumController::class,'index'])->name('forum')->middleware('auth');
