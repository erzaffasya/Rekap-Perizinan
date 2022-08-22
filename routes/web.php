<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\KategoriHelpdeskController;
use App\Http\Controllers\NSeksiController;
use App\Http\Controllers\NSektorController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Sektor\SektorKesehatanController;
use App\Http\Controllers\Sektor\SektorPendidikanController;
use App\Http\Controllers\Sektor\SektorPerdaganganController;
use App\Http\Controllers\Sektor\SektorPertahananController;
use App\Http\Controllers\TerbitController;
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
    return view('auth.login');
});
// Route::get('/dashboard', function () {
//     return view('admin.index');
// });
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');
    Route::post('importPermohonan', [PermohonanController::class, 'importPermohonan'])->name('importPermohonan');
    Route::get('exportPermohonan', [PermohonanController::class, 'exportPermohonan'])->name('exportPermohonan');
    Route::get('exportTerbit', [TerbitController::class, 'exportTerbit'])->name('exportTerbit');
    Route::get('cariTahunTerbit', [TerbitController::class, 'cariTahunTerbit'])->name('cariTahunTerbit');
    Route::get('cariTahunPermohonan', [PermohonanController::class, 'cariTahunPermohonan'])->name('cariTahunPermohonan');
    Route::get('detail-terbit/{id}', [TerbitController::class, 'showterbit'])->name('showterbit');
    Route::resource('Perizinan', PerizinanController::class);
    Route::resource('Permohonan', PermohonanController::class);
    Route::resource('Terbit', TerbitController::class);
    Route::resource('Seksi', RoleController::class);
    Route::resource('Role', RoleController::class);
    Route::resource('KategoriHelpdesk', KategoriHelpdeskController::class);
    Route::resource('NSeksi', NSeksiController::class);
    Route::resource('NSektor', NSektorController::class);

    // Pertanahan     
    Route::get('filterPertanahan', [SektorPertahananController::class, 'index'])->name('filterPertanahan');
    Route::get('detailData/filterPertanahan', [SektorPertahananController::class, 'detailData'])->name('detailPertanahan');
    Route::get('getSeksiPerdangan/{id}', [SektorPertahananController::class, 'getSeksi'])->name('getSeksiPerdangan');
    Route::resource('Pertanahan', SektorPertahananController::class);
    Route::post('importPertanahan', [SektorPertahananController::class, 'importData'])->name('importPertanahan');

    //Kesehatan    

    Route::get('filterKesehatan', [SektorKesehatanController::class, 'index'])->name('filterKesehatan');
    Route::get('detailData/filterKesehatan', [SektorKesehatanController::class, 'detailData'])->name('detailKesehatan');
    Route::get('getSeksi/{id}', [SektorKesehatanController::class, 'getSeksi'])->name('getSeksi');
    Route::resource('Kesehatan', SektorKesehatanController::class);
    Route::post('importKesehatan', [SektorKesehatanController::class, 'importKesehatan'])->name('importKesehatan');

    //Pendidikan
    Route::get('filterPendidikan', [SektorPendidikanController::class, 'index'])->name('filterPendidikan');
    Route::get('detailData/filterPendidikan', [SektorPendidikanController::class, 'detailData'])->name('detailPendidikan');
    Route::get('getSeksiPerdangan/{id}', [SektorPendidikanController::class, 'getSeksi'])->name('getSeksiPerdangan');
    Route::resource('Pendidikan', SektorPendidikanController::class);
    Route::post('importPendidikan', [SektorPendidikanController::class, 'importPendidikan'])->name('importPendidikan');
    
    //Perdagangan
    Route::get('filterPerdagangan', [SektorPerdaganganController::class, 'index'])->name('filterPerdagangan');
    Route::get('detailData/filterPerdagangan', [SektorPerdaganganController::class, 'detailData'])->name('detailPerdagangan');
    Route::get('getSeksiPerdangan/{id}', [SektorPerdaganganController::class, 'getSeksi'])->name('getSeksiPerdangan');
    Route::resource('Perdagangan', SektorPerdaganganController::class);
    Route::post('importPerdagangan', [SektorPerdaganganController::class, 'importPerdagangan'])->name('importPerdagangan');
});

Route::post('Helpdesk/send-helpdesk', [HelpdeskController::class, 'store'])->name('sendHelpdesk');
Route::resource('Helpdesk', HelpdeskController::class);
require __DIR__ . '/auth.php';
