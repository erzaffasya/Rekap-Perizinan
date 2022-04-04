<?php

use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\PermohonanController;
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
    return view('welcome');
});

// Route::get('/Program/{program}/Divisi/{id}', [GuestController::class, 'show'])->name('');
Route::resource('Perizinan', PerizinanController::class);
Route::resource('Permohonan', PermohonanController::class);
Route::resource('Terbit', TerbitController::class);
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
