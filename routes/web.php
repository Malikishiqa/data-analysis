<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Bus;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
// use Illuminate\Container\Attributes\Auth as ;
// use Laravel\Ui\AuthRouteMethods;

Route::get('/', function () {
    return view('auth.login');
});
// Auth::routes();
// Login Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
// Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

// import csv file
Route::get('/import-csv', [\App\Http\Controllers\CSVImportController::class, 'index']);
// Route::get('/batch-progress/{batchId}', 'BatchProgressController@index');
Route::get('/import-progress/{batchId}', [\App\Http\Controllers\BatchProgressController::class, 'checkImportProgress']);
Route::post('/import-csv', [\App\Http\Controllers\CSVImportController::class, 'import'])->name('import.csv');
Route::get('/tables', [\App\Http\Controllers\CSVImportController::class, 'tables'])->name('tables');
Route::get('/table/{table}', [\App\Http\Controllers\CSVImportController::class, 'showTable'])->name('table.show');
Route::delete('/table/{table}/delete/{id}', [\App\Http\Controllers\CSVImportController::class, 'deleteTableItem'])->name('table.delete');
Route::put('/table/{table}', [\App\Http\Controllers\CSVImportController::class, 'updateTableItem'])->name('table.update');
Route::get('/table/{table}/search', [\App\Http\Controllers\CSVImportController::class, 'search'])->name('table.search');
Route::post('/notifications/mark-as-read/{id}', [\App\Http\Controllers\CSVImportController::class, 'markAsRead'])->name('notifications');
Route::get('/socialite/{driver}', [\App\Http\Controllers\SocialLoginController::class, 'toProvider'])->where('driver','github|google');
Route::get('/auth/{driver}/login', [\App\Http\Controllers\SocialLoginController::class, 'handleCallback'])->where('driver','github|google');

// header mn jaa k source code mn mera wala link add krdo  kon s link