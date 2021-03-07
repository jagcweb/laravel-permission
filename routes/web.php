<?php

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin')->middleware('permission:access-admin');
Route::get('/my-account', [App\Http\Controllers\HomeController::class, 'myAccount'])->name('myaccount')->middleware('permission:access-myaccount');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact')->middleware('permission:access-contact');
Route::get('/view-users', [App\Http\Controllers\HomeController::class, 'viewUsers'])->name('viewusers')->middleware('permission:access-viewusers');
Route::get('/edit-users', [App\Http\Controllers\HomeController::class, 'editUsers'])->name('editusers')->middleware('permission:access-editusers');

