<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\TransaksiController;
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
//ADMIN
//-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => ['role:admin']], function (){

// Cabang admin
//-----------------------------------------------------------------------------------------------------------
Route::get('/cabang', [CabangController::class, 'index'])->name('cabang.index');
Route::get('/cabang/create', [CabangController::class, 'create'])->name('cabang.create');
Route::post('/cabang', [CabangController::class, 'store'])->name('cabang.store');
Route::get('/cabang/{cabang}', [CabangController::class, 'show'])->name('cabang.show');
Route::get('/cabang/{cabang}/edit', [CabangController::class, 'edit'])->name('cabang.edit');
Route::put('/cabang/{cabang}', [CabangController::class, 'update'])->name('cabang.update');
Route::delete('/cabang/{cabang}', [CabangController::class, 'destroy'])->name('cabang.destroy');
//-----------------------------------------------------------------------------------------------------------

//Transaksi admin
//-----------------------------------------------------------------------------------------------------------
Route::get('/transaksi/', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/show', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');

//------------------------------------------------------------------------------------------------------------



});
//-----------------------------------------------------------------------------------------------------------

//MANAGER
//-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => ['role:manager']], function (){
    // Rute untuk menampilkan daftar cabang (Index)
    Route::get('/cabang/view', [CabangController::class, 'view'])->name('cabang.view');
    });

//-----------------------------------------------------------------------------------------------------------


//TRANSAKSI
//-----------------------------------------------------------------------------------------------------------
    Route::group(['middleware' => ['role:kasir']], function () {
        Route::get('/transaksi/', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('/transaksi/show', [TransaksiController::class, 'show'])->name('transaksi.show');
        Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');

        
    
        // Route::get('/transaksi/print', [BookController::class, 'print'])->name('transaksi.print');
        // Route::get('/transaksi/export', [BookController::class, 'export'])->name('transaksi.export');
        // Route::post('/transaksi/import', [BookController::class, 'import'])->name('book.import');
    });
//-----------------------------------------------------------------------------------------------------------

    
require __DIR__.'/auth.php';
