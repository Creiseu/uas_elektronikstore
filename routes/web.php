<?php

use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin',function(){
    return view('admin.index');
})->name('admin')->middleware('admin');

Route::get('manager',function(){
    return view('manager.index');
})->name('manager')->middleware('manager');

Route::get('customer',function(){
    return view('customer.index');
})->name('customer')->middleware('customer');

// Route::get('cashier',function(){
//     return view('kasir.index');
// })->name('posts')->middleware('cashier');
Route::get('/cashier',[KasirController::class, 'home'])->name('kasir')->middleware('cashier'); //ketika login akan ke home untuk pilih data
Route::get('/cashier', [KasirController::class, 'home'])->name('kasir.home');//kembali ke home
Route::get('/kasir/search', [KasirController::class, 'search'])->name('kasir.search');//untuk fitur pencarian
Route::get('/kategori',[KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/search', [KategoriController::class, 'search'])->name('kategori.search');
Auth::routes();
Route::resource('/kasir', KasirController::class);
Route::resource('/kategori', KategoriController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
