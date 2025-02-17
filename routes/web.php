<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin dashboard , 'admin'
Route::middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('dashboard');
    Route::resources([
        'categories' => CategoryController::class,
        'users' => UserController::class,
    ]);
    Route::put('/categories/updateImage/{category}', [CategoryController::class, 'updateImage'])->name('categories.updateImage');
    Route::put('/users/updatePassword/{user}', [UserController::class, 'updatePassword'])->name('users.updatePassword');
});


require __DIR__.'/auth.php';
