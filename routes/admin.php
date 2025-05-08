<?php
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\InternController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;

Route::prefix('admin')->group(function () {

    Route::middleware("guest:admin")->group(function () {
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register.form');
        Route::post('/register', [RegisterController::class, 'register'])->name('admin.register');

        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('tasks')->group(function () {
            Route::get('/', [TaskController::class, 'index'])->name('tasks.index')->can('manage-tasks');
            Route::get('/create', [TaskController::class, 'create'])->name('tasks.create')->can('manage-tasks');
            Route::post('/create', [TaskController::class, 'store'])->name('tasks.store')->can('manage-tasks');
            Route::get('/{task}', [TaskController::class, 'show'])->name('tasks.show')->can('manage-tasks');
            Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit')->can('manage-tasks');
            Route::patch('/{task}/update', [TaskController::class, 'update'])->name('tasks.update')->can('manage-tasks');
            Route::delete('/{task}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy')->can('manage-tasks');
            Route::post('/{task}/comments', [TaskController::class, 'addComment'])->name('tasks.comments.add')->can('manage-tasks');
        });

        Route::prefix('interns')->group(function () {
            Route::get('/', [InternController::class, 'index'])->name('interns.index')->can('manage-interns');
            Route::get('/create', [InternController::class, 'create'])->name('interns.create')->can('manage-interns');
            Route::post('/create', [InternController::class, 'store'])->name('interns.store')->can('manage-interns');
            Route::get('/assign', [InternController::class, 'assign'])->name('interns.assign')->can('manage-interns');
            Route::post('/assign', [InternController::class, 'assignStore'])->name('interns.assign.store')->can('manage-interns');
            Route::get('/{iterns}', [InternController::class, 'show'])->name('interns.show')->can('manage-interns');
            Route::get('/{intern}/edit', [InternController::class, 'edit'])->name('interns.edit')->can('manage-interns');
            Route::patch('/{intern}/update', [InternController::class, 'update'])->name('interns.update')->can('manage-interns');
            Route::delete('/{intern}/delete', [InternController::class, 'destroy'])->name('interns.destroy')->can('manage-interns');
        });
        Route::prefix('admins')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('admins.index')->can('manage-admins');
            Route::get('/create', [AdminController::class, 'create'])->name('admins.create')->can('manage-admins');
            Route::post('/create', [AdminController::class, 'store'])->name('admins.store')->can('manage-admins');
            Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit')->can('manage-admins');
            Route::patch('/{admin}/update', [AdminController::class, 'update'])->name('admins.update')->can('manage-admins');
            Route::delete('/{admin}/delete', [AdminController::class, 'destroy'])->name('admins.destroy')->can('manage-admins');
        });
        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('roles.index')->can('manage-roles');
            Route::get('/create', [RoleController::class, 'create'])->name('roles.create')->can('manage-roles');
            Route::post('/create', [RoleController::class, 'store'])->name('roles.store')->can('manage-roles');
            Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->can('manage-roles');
            Route::patch('/{role}/update', [RoleController::class, 'update'])->name('roles.update')->can('manage-roles');
            Route::delete('/{role}/delete', [RoleController::class, 'destroy'])->name('roles.destroy')->can('manage-roles');
        });
        Route::prefix('permissions')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('permissions.index')->can('manage-permissions');
            Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create')->can('manage-permissions');
            Route::post('/create', [PermissionController::class, 'store'])->name('permissions.store')->can('manage-permissions');
            Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->can('manage-permissions');
            Route::patch('/{permission}/update', [PermissionController::class, 'update'])->name('permissions.update')->can('manage-permissions');
            Route::delete('/{permission}/delete', [PermissionController::class, 'destroy'])->name('permissions.destroy')->can('manage-permissions');
        });
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    });

});