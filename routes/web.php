<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController; // Importa el controlador ProfileController

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // ... Otras rutas ...

    // Rutas para productos
    Route::resource('admin/products', ProductController::class);

    // Rutas para categorías
    Route::resource('admin/categories', CategoryController::class);

    // Rutas para proveedores
    Route::resource('admin/providers', ProviderController::class);

    // Rutas para usuarios
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::put('admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

});