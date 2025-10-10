<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;


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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('auth');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export')->middleware('auth');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
Route::get('/', [ContactController::class, 'create'])->name('contact.create');

// 確認画面
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

// DB保存してサンクス画面へ
Route::post('/send', [ContactController::class, 'send'])->name('contact.send');

// サンクス画面
Route::get('/thanks', [ContactController::class, 'thanksView'])->name('contact.thanks');
