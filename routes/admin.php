<?php
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\InternController;

Route::prefix('admin')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('admin.register');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');

        Route::prefix('tasks')->group(function () {
            Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
            Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
            Route::post('/create', [TaskController::class, 'store'])->name('tasks.store');  // Changed from Route::post('/', ...)
            Route::get('/{task}', [TaskController::class, 'show'])->name('tasks.show');
            Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
            Route::patch('/{task}/update', [TaskController::class, 'update'])->name('tasks.update');
            Route::delete('/{task}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy');
        });

        Route::prefix('interns')->group(function () {
            Route::get('/', [InternController::class, 'index'])->name('interns.index');
            Route::get('/create', [InternController::class, 'create'])->name('interns.create');
            Route::post('/create', [InternController::class, 'store'])->name('interns.store');
            Route::get('/assign', [InternController::class, 'assign'])->name('interns.assign');
            Route::post('/assign', [InternController::class, 'assignStore'])->name('interns.assign.store');
            Route::get('/{iterns}', [InternController::class, 'show'])->name('interns.show');
            Route::get('/{intern}/edit', [InternController::class, 'edit'])->name('interns.edit');
            Route::patch('/{intern}/update', [InternController::class, 'update'])->name('interns.update');
            Route::delete('/{intern}/delete', [InternController::class, 'destroy'])->name('interns.destroy');
        });

    });
});


