<?php

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

    // Placeholder routes for sidebar navigation
    Route::get('/absensi', function () {
        return view('absensi.index');
    })->name('absensi.index');
    Route::get('/report', function () {
        return view('report.index');
    })->name('report.index');
});
