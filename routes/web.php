<?php


use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});

// Rutas para usuarios autenticados
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Rutas para el panel de control (dashboard)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas para productos
    Route::resource('admin/products', ProductController::class);

    // Rutas para categorías
    Route::resource('admin/categories', CategoryController::class);

    // Rutas para proveedores
    Route::resource('admin/providers', ProviderController::class);

    // Rutas para usuarios
    Route::prefix('admin/users')->name('admin.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
    });

    
    // Rutas para el perfil de usuario
    Route::prefix('admin/profile')->name('profile.')->middleware(['auth:sanctum', 'verified'])->group(function () {
        // Mostrar perfil
        Route::get('/', [ProfileController::class, 'show'])->name('show');

        // Editar perfil
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');

        // Actualizar perfil
        Route::put('/update', [ProfileController::class, 'update'])->name('update');

        // Mostrar formulario para cambiar contraseña
        Route::get('/update-password', [ProfileController::class, 'updatePasswordView'])->name('updatePasswordView');

        // Actualizar contraseña
        Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    });

    // Rutas para roles
    Route::prefix('admin/roles')->name('admin.roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
        Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
    });
});

