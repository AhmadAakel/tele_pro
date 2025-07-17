<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/channel/{channelId}/users', [DashboardController::class, 'usersByChannel'])->name('admin.channel.users');
    Route::get('/verifiedusers', [DashboardController::class, 'showverifiedusers'])->name('verifiedusers');
    Route::get('/allusers', [DashboardController::class, 'showallusers'])->name('allusers');
    Route::delete('/allusers/{id}', [DashboardController::class, 'destroy'])->name('users.destroy');
    Route::put('/channel/{id}', [DashboardController::class, 'updateChannel'])->name('admin.channel.update');
    Route::post('/channel', [DashboardController::class, 'addChannel'])->name('admin.channel.add');
    Route::get('/search', [DashboardController::class, 'search'])->name('user.search');
    Route::get('/admin/verified-users/search', [DashboardController::class, 'searchVerified'])->name('verified.user.search');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});
// require __DIR__.'/auth.php';