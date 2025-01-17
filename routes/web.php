<?php
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\StockMovementController;
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

// barang admin
//-----------------------------------------------------------------------------------------------------------
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('/barang/admin-cabang-satu', [StokController::class, 'adminViewCabangSatu'])->name('barang.view1');
Route::get('/barang/admin-cabang-dua', [StokController::class, 'adminViewCabangdua'])->name('barang.view2');
Route::get('/barang/admin-cabang-tiga', [StokController::class, 'adminViewCabangtiga'])->name('barang.view3');
Route::get('/barang/admin-cabang-empat', [StokController::class, 'adminViewCabangempat'])->name('barang.view4');
Route::get('/barang/admin-cabang-lima', [StokController::class, 'adminViewCabanglima'])->name('barang.view5');

//-----------------------------------------------------------------------------------------------------------

// stock_movements admin
//-----------------------------------------------------------------------------------------------------------
// Route::get('/StockMovement', [StockMovementController::class, 'index'])->name('stock_movements.index');
// Route::get('/StockMovement/create', [StockMovementController::class, 'create'])->name('stock_movements.create');
// Route::post('/StockMovement', [StockMovementController::class, 'store'])->name('stock_movements.store');
// // Route::get('/StockMovement/{StockMovement}', [StockMovementController::class, 'show'])->name('StockMovement.show');
// Route::get('/StockMovement/{StockMovement}/edit', [StockMovementController::class, 'edit'])->name('stock_movements.edit');
// Route::put('/StockMovement/{StockMovement}', [StockMovementController::class, 'update'])->name('stock_movements.update');
// Route::delete('/StockMovement/{StockMovement}', [StockMovementController::class, 'destroy'])->name('.destroy');
// Route::get('/StockMovement/print', [StockMovementController::class, 'print'])->name('stock_movements.print');
// Route::get('/StockMovement/export', [StockMovementController::class, 'export'])->name('stock_movements.export');
// Route::post('/StockMovement/import', [StockMovementController::class, 'import'])->name('stock_movements.import');
//-----------------------------------------------------------------------------------------------------------

//Transaksi admin
//-----------------------------------------------------------------------------------------------------------
Route::get('/transaksi/', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/show', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/print', [TransaksiController::class, 'print'])->name('transaksi.print');
Route::get('/transaksi/export', [TransaksiController::class, 'export'])->name('transaksi.export');
Route::post('/transaksi/import', [TransaksiController::class, 'import'])->name('transaksi.import');

//------------------------------------------------------------------------------------------------------------



});
//-----------------------------------------------------------------------------------------------------------

//MANAGER
//-----------------------------------------------------------------------------------------------------------
// Route::group(['middleware' => ['role:manager']], function (){
//     // Rute untuk menampilkan daftar cabang (Index)
//     Route::get('/transaksi/view', [TransaksiController::class, 'view'])->name('transaksi.view');
//     });
//-----------------------------------------------------------------------------------------------------------

//SUPERVISOR
//-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => ['role:supervisor|manager']], function (){
    // Rute untuk menampilkan daftar cabang (Index)
    Route::get('/transaksi/view', [TransaksiController::class, 'view'])->name('transaksi.view');
    });
//-----------------------------------------------------------------------------------------------------------

//GUDANG
//-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => ['role:gudang|admin|manager|supervisor']], function (){
    Route::get('/StockMovement', [StockMovementController::class, 'index'])->name('stock_movements.index');
    Route::get('/StockMovement/create', [StockMovementController::class, 'create'])->name('stock_movements.create');
    Route::post('/StockMovement', [StockMovementController::class, 'store'])->name('stock_movements.store');
    Route::get('/StockMovement/{StockMovement}/edit', [StockMovementController::class, 'edit'])->name('stock_movements.edit');
    Route::put('/StockMovement/{StockMovement}', [StockMovementController::class, 'update'])->name('stock_movements.update');
    Route::delete('/StockMovement/{StockMovement}', [StockMovementController::class, 'destroy'])->name('.destroy');
    Route::get('/StockMovement/print', [StockMovementController::class, 'print'])->name('stock_movements.print');
    Route::get('/StockMovement/export', [StockMovementController::class, 'export'])->name('stock_movements.export');
    Route::post('/StockMovement/import', [StockMovementController::class, 'import'])->name('stock_movements.import');
    });

//-----------------------------------------------------------------------------------------------------------


//KASIR
//-----------------------------------------------------------------------------------------------------------
Route::group(['middleware' => ['role:kasir|admin|manager|supervisor']], function () {
    Route::get('/transaksi/', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/show', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/print', [TransaksiController::class, 'print'])->name('transaksi.print');
    Route::get('/transaksi/export', [TransaksiController::class, 'export'])->name('transaksi.export');
    Route::post('/transaksi/import', [TransaksiController::class, 'import'])->name('transaksi.import');
    Route::get('/barang/view', [StokController::class, 'index'])->name('barang.view');
    Route::get('/barang/print', [BarangController::class, 'print'])->name('barang.print');
    Route::get('/barang/export', [BarangController::class, 'export'])->name('barang.export');
    });
//-----------------------------------------------------------------------------------------------------------

    
require __DIR__.'/auth.php';
