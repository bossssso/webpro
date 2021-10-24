<?php

use App\Http\Controllers\MaindishController;
use App\Http\Controllers\MenutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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


Route::get('/maindish',[MaindishController::class, 'list'])->name('maindish-list');
Route::get('/maindish/create',[MaindishController::class,'createForm'])->name('maindish-create-form');
Route::post('/maindish/create',[MaindishController::class,'create'])->name('maindish-create');
Route::get('/maindish/{code}/update',[MaindishController::class,'updateForm'])->name('maindish-update-form');
Route::post('/maindish/{code}/update',[MaindishController::class,'update'])->name('maindish-update');
Route::get('/maindish/{code}/delete',[MaindishController::class,'delete'])->name('maindish-delete');
Route::get('/maindish/{code}',[MaindishController::class,'detail'])->name('maindish-detail');


Route::get('/menut',[MenutController::class, 'list'])->name('menut-list');
Route::get('/menut/create',[MenutController::class,'createForm'])->name('menut-create-form');
Route::post('/menut/create',[MenutController::class,'create'])->name('menut-create');
Route::get('/menut/{code}/update',[MenutController::class,'updateForm'])->name('menut-update-form');
Route::post('/menut/{code}/update',[MenutController::class,'update'])->name('menut-update');
Route::get('/menut/{code}/delete',[MenutController::class,'delete'])->name('menut-delete');
Route::get('/menut/{code}',[MenutController::class,'detail'])->name('menut-detail');
Route::get('/menut/{code}/maindish',[MenutController::class,'showmaindish'])->name('menut-detail-maindish');
Route::get('/menut/{code}/maindish/add',[MenutController::class,'addmaindishForm'])->name('menut-add-maindish-form');
Route::post('/menut/{code}/maindish/add',[MenutController::class,'addmaindish'])->name('menut-add-maindish');
Route::get('/menut/{menut}/maindish/{maindish}/remove',[MenutController::class,'removemaindish'])->name('menut-remove-maindish');


Route::get('/user',[UserController::class, 'list'])->name('user-list');
Route::get('/user/create',[UserController::class,'createForm'])->name('user-create-form');
Route::post('/user/create',[UserController::class,'create'])->name('user-create');
Route::get('/user/{email}/update',[UserController::class,'updateForm'])->name('user-update-form');
Route::post('/user/{email}/update',[UserController::class,'update'])->name('user-update');
Route::get('/user/{email}/delete',[UserController::class,'delete'])->name('user-delete');
Route::get('/user/{email}',[UserController::class,'detail'])->name('user-detail');


Route::get('/auth/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/auth/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout');