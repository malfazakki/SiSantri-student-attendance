<?php

use App\Http\Controllers\Auth\MentorAuthController;
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
    return view('mentor.login');
});

// Mentor Authentication Routes
Route::get('/login', [MentorAuthController::class, 'showLoginForm'])->name('mentor.login');
Route::post('/login', [MentorAuthController::class, 'login']);
Route::post('/logout', [MentorAuthController::class, 'logout'])->name('mentor.logout');

// Protected Routes
Route::middleware('auth:mentor')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
