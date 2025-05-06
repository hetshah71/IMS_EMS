<?php
include_once 'admin.php';
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Intern\Auth\LoginController as InternLoginController;
use App\Http\Controllers\Intern\Auth\RegisterController as InternRegisterController;
use App\Http\Controllers\Intern\TaskController as InternTaskController;
use App\Http\Controllers\Intern\HomeController;

Route::get('/register', [InternRegisterController::class, 'showRegistrationForm'])->name('intern.register.form');
Route::post('/register', [InternRegisterController::class, 'register'])->name('intern.register');

Route::get('/login', [InternLoginController::class, 'showLoginForm'])->name('intern.login.form');
Route::post('/login', [InternLoginController::class, 'login'])->name('intern.login');
Route::post('/logout', [InternLoginController::class, 'logout'])->name('intern.logout');

Route::middleware('auth:intern')->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('intern.dashboard');

    Route::prefix('tasks')->group(function () {
        Route::get('/', [InternTaskController::class, 'index'])->name('intern.tasks.index');
    });
});