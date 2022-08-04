<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\IMTNController;
use App\Http\Controllers\KategoriHelpdeskController;
use App\Http\Controllers\NDataController;
use App\Http\Controllers\NSeksiController;
use App\Http\Controllers\NSektorController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TerbitController;
use App\Imports\IMTNImport;
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
    Route::resource('NData', NDataController::class);
    Route::post('importNData', [NDataController::class, 'importNData'])->name('importNData');

    // IMTN     
    Route::resource('IMTN', IMTNController::class);
    Route::post('importIMTN', [IMTNController::class, 'importData'])->name('importIMTN');
});
Route::post('Helpdesk/send-helpdesk', [HelpdeskController::class, 'store'])->name('sendHelpdesk');
Route::get('filterData', [NDataController::class, 'index'])->name('filterData');
Route::get('detailData/filterData', [NDataController::class, 'detailData'])->name('detailData');
Route::get('getSeksi/{id}', [NDataController::class, 'getSeksi'])->name('getSeksi');
Route::resource('Helpdesk', HelpdeskController::class);
require __DIR__ . '/auth.php';
