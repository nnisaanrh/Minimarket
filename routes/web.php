<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CabangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

Route::group(['middleware' => ['role:admin']], function (){
// Rute untuk menampilkan daftar cabang (Index)
Route::get('/cabang', [CabangController::class, 'index'])->name('cabang.index');
// Rute untuk menampilkan form tambah cabang (Create)
Route::get('/cabang/create', [CabangController::class, 'create'])->name('cabang.create');
// Rute untuk menyimpan cabang baru (Store)
Route::post('/cabang', [CabangController::class, 'store'])->name('cabang.store');
// Rute untuk menampilkan detail cabang (Show) - Optional, bisa ditambahkan sesuai kebutuhan
Route::get('/cabang/{cabang}', [CabangController::class, 'show'])->name('cabang.show');
// Rute untuk menampilkan form edit cabang (Edit)
Route::get('/cabang/{cabang}/edit', [CabangController::class, 'edit'])->name('cabang.edit');
// Rute untuk memperbarui cabang (Update)
Route::put('/cabang/{cabang}', [CabangController::class, 'update'])->name('cabang.update');
// Rute untuk menghapus cabang (Destroy)
Route::delete('/cabang/{cabang}', [CabangController::class, 'destroy'])->name('cabang.destroy');
});

Route::group(['middleware' => ['role:manager']], function (){
    // Rute untuk menampilkan daftar cabang (Index)
    Route::get('/cabang/view', [CabangController::class, 'view'])->name('cabang.view');
    });



require __DIR__.'/auth.php';
