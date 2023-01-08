<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\restoranController;
use App\Http\Controllers\userController;
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

Route::get('/', function () {
    return view('home');
});


// User Retoran
// Restoran
Route::get('/halaman-resto', [restoranController::class, 'index'])->middleware('auth');
Route::get('/restoranku', [restoranController::class, 'index'])->middleware('auth');
Route::get('/tabel-restoranku', [restoranController::class, 'tabelRestoran'])->middleware('auth');
Route::get('/tambah-resto', [restoranController::class, 'create'])->middleware('auth');
Route::post('/upload-resto', [restoranController::class, 'store'])->middleware('auth');
Route::get('/restoran/edit/{id}', [restoranController::class, 'edit'])->middleware('auth');
Route::post('/update/resto/{id}', [restoranController::class, 'update'])->middleware('auth');
Route::delete('restoran/hapus/{id}', [restoranController::class, 'destroy'])->middleware('auth');
// Menu
Route::get('/restoran/menu/{id}', [menuController::class, 'menu']);
Route::post('/restoran/menu/upload-menu', [menuController::class, 'store'])->middleware('auth');
Route::get('/restoran/menu/edit/{id}/{idR}', [menuController::class, 'edit'])->middleware('auth');
Route::post('/restoran/menu/update/{id}', [menuController::class, 'update'])->middleware('auth');
Route::post('/restoran/menu/jenis-menu', [menuController::class, 'tjenisMenu'])->middleware('auth');
Route::delete('restoran/menu/hapus/{id}', [menuController::class, 'destroy'])->middleware('auth');
Route::delete('restoran/menu/jenis-menu/hapus/{id}', [menuController::class, 'deleteJenisMenu'])->middleware('auth');
Route::get('/restoran/menu/detail/{id}/{idR}', [menuController::class, 'detail']);
Route::post('/tambah-gambar/{id}', [menuController::class, 'tambahGambar'])->middleware('auth');
Route::post('/review-menu/{id}', [menuController::class, 'reviewMenu'])->middleware('auth');
Route::get('/edit-gambar/menu/{id}/{idM}', [menuController::class, 'editGambar'])->middleware('auth');
Route::post('/update/gambar/{id}', [menuController::class, 'updateGambar'])->middleware('auth');
Route::delete('hapus/gambar/{id}', [menuController::class, 'destroyGambar'])->middleware('auth');

// User Pengunjung
Route::get('/cari-resto', function () {
    return view('content.restoran.cariResto');
});
Route::get('/cari-makan', function () {
    return view('content.menu.cariMakan');
});
Route::get('/rating-resto', function () {
    return view('content.restoran.restoRating');
});
Route::post('/review-resto/{id}', [menuController::class, 'reviewResto'])->middleware('auth');
Route::post('/restoran/menu/rating/{id}', [menuController::class, 'tambahRating'])->middleware('auth');


// login
Route::get('/login', [loginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/masuk', [loginController::class, 'authenticate'])->middleware('guest');
Route::get('/logout', [loginController::class, 'logout'])->middleware('auth');

// Register
Route::get('/register', [loginController::class, 'register'])->middleware('guest');
Route::post('/registrasi', [userController::class, 'registrasi'])->middleware('guest');
