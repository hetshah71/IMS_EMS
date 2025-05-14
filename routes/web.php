<?php

include_once 'admin.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Intern\Auth\LoginController as InternLoginController;
use App\Http\Controllers\Intern\Auth\RegisterController as InternRegisterController;
use App\Http\Controllers\Intern\TaskController as InternTaskController;
use App\Http\Controllers\Intern\HomeController;
use App\Http\Controllers\Intern\ChatController;
use App\Http\Controllers\NotificationController;

Route::middleware('guest:intern')->group(function () {
    Route::get('/register', [InternRegisterController::class, 'showRegistrationForm'])->name('intern.register.form');
    Route::post('/register', [InternRegisterController::class, 'register'])->name('intern.register');

    Route::get('/login', [InternLoginController::class, 'showLoginForm'])->name('intern.login.form');
    Route::post('/login', [InternLoginController::class, 'login'])->name('intern.login');
});



Route::middleware('auth:intern')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('intern.dashboard');

    Route::prefix('tasks')->group(function () {
        Route::get('/', [InternTaskController::class, 'index'])->name('intern.tasks.index');
    });
    Route::get('chat', [ChatController::class, 'index'])->name('intern.chat.index');
    Route::get('chat/{user}', [ChatController::class, 'show'])->name('intern.chat.show');
    Route::post('chat/{user}', [ChatController::class, 'sendMessage'])->name('intern.chat.send');
    Route::post('/logout', [InternLoginController::class, 'logout'])->name('intern.logout');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('intern.notifications.index');
    Route::get('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('intern.notifications.markAsRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('intern.notifications.destroy');
    Route::delete('/notifications', [NotificationController::class, 'clearAll'])->name('intern.notifications.clearAll');
});
