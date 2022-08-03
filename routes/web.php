<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GambarKamarController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KosanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegistrationController;
use App\Models\GambarKamar;
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

Route::get('/', [Controller::class, 'index'])->name('home');
Route::get('/daftar-kosan', [Controller::class, 'daftarKos'])->name('daftarKos');
Route::get('/detail-kos/{id}', [HomepageController::class, 'detailKos'])->name('detail_kos');
Route::get('/detail-kamar/{id}', [HomepageController::class, 'detailKamar'])->name('detail_kamar');
Route::get('/maintenance', [HomepageController::class, 'maintenance'])->name('maintenance');

Route::group(['middleware' => 'guest:web,owner'], function () {
    Route::resource('login', LoginController::class);
    Route::resource('registration', RegistrationController::class);
});
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');


Route::group(['middleware' => 'auth:owner'], function () {
    Route::get('/gambar/{id}', [GambarKamarController::class, 'Gambar'])->name('gambar-kamar.gambar');
    Route::get('/report-room', [OwnerController::class, 'reportRoom'])->name('report_room');
    Route::get('/report-payment', [OwnerController::class, 'reportPayment'])->name('report_payment');
    // Route::get('/settings', [OwnerController::class, 'ownerSettings'])->name('owner_settings');
    Route::resource('gambar-kamar', GambarKamarController::class);
    Route::resource('kamar', KamarController::class);
    Route::resource('owner', OwnerController::class);
    Route::resource('kosan', KosanController::class);
});

Route::group(['middleware' => 'auth:web'], function () {
    Route::post('/bayar-bulanan', [ClientController::class, 'payMonthly'])->name('pay_monthly');
    Route::get('/kamar-data/{id}', [ClientController::class, 'responseRoomActive'])->name('response_rooms');
    Route::get('/pembayaran', [ClientController::class, 'monthly'])->name('monthly');
    Route::resource('client', ClientController::class);
});

Route::group(['middleware' => 'auth:web,owner'], function () {
    Route::resource('payment', PaymentController::class);
});