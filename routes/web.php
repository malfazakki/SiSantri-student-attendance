<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Auth\MentorAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SesiAbsenController;
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
    return redirect()->route('mentor.login');
});

// Mentor Authentication Routes
Route::get('/login', [MentorAuthController::class, 'showLoginForm'])->name('mentor.login');
Route::post('/login', [MentorAuthController::class, 'login']);
Route::post('/logout', [MentorAuthController::class, 'logout'])->name('mentor.logout');

// Protected Routes
Route::middleware('auth:mentor')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Sesi Absen Routes
    Route::resource('sesi', SesiAbsenController::class);
    Route::patch('/sesi/{sesi}/toggle-active', [SesiAbsenController::class, 'toggleActive'])->name('sesi.toggle-active');

    // Absensi Routes
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/history', [AbsensiController::class, 'history'])->name('absensi.history');

    // Placeholder routes for sidebar navigation
    Route::get('/report', function () {
        return view('report.index');
    })->name('report.index');
});
