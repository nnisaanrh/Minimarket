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

    Route::get('/cabang', [CabangController::class, 'index'])->name('cabang');
});

Route::group(['middleware' => ['role:pustakawan']], function () {
    Route::get('/cabang/create', [CabangController::class, 'create'])->name('cabang.create');
    Route::get('/cabang/edit/{id}', [CabangController::class, 'edit'])->name('cabang.edit');
    Route::post('/cabang/store', [CabangController::class, 'store'])->name('cabang.store');
    Route::patch('/cabang/{id}/update', [CabangController::class, 'update'])->name('cabang.update');
    Route::delete('/cabang/{id}/delete', [CabangController::class, 'destroy'])->name('cabang.destroy');

    Route::get('/cabang/print', [CabangController::class, 'print'])->name('cabang.print');
    Route::get('/cabang/export', [CabangController::class, 'export'])->name('cabang.export');
    Route::post('/cabang/import', [CabangController::class, 'import'])->name('cabang.import');
});

require __DIR__.'/auth.php';
