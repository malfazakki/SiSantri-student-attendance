<?php

use App\Http\Controllers\Auth\MentorAuthController;
use App\Http\Controllers\DashboardController;
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

    // Placeholder routes for sidebar navigation
    Route::get('/absensi', function() { return view('absensi.index'); })->name('absensi.index');
    Route::get('/sesi', function() { return view('sesi.index'); })->name('sesi.index');
    Route::get('/report', function() { return view('report.index'); })->name('report.index');
});
