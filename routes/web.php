<?php


use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ActivityController;
use App\Http\Controller\ProductImageController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationDetailController;
use App\Http\Controllers\ShopliveController;
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
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Rutas para almacenar y eliminar imágenes del product


// Rutas para almacenar y eliminar imágenes del producto
Route::post('/product-images', [ProductImageController::class, 'store'])->name('product-images.store');
Route::put('/product-images/{productImage}', [ProductImageController::class, 'update'])->name('product-images.update');
Route::delete('/product-images/{productImage}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');

Route::post('/reservations/create/{productId}', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');


Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
// Ruta para mostrar los precios de los productos
// Rutas para editar y eliminar precios de productos
Route::post('product_prices', [ProductPriceController::class, 'store'])->name('product_prices.store');
Route::get('product_prices/{productPrice}/edit', [ProductPriceController::class, 'edit'])->name('product_prices.edit');
Route::put('product_prices/{productPrice}', [ProductPriceController::class, 'update'])->name('product_prices.update');
Route::delete('product_prices/{productPrice}', [ProductPriceController::class, 'destroy'])->name('product_prices.destroy');
Route::get('product_prices/{product}', [ProductPriceController::class, 'show'])->name('product_prices.show');
    });
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
        Route::get('/actualizar-roles', 'RoleController@actualizarRoles')->name('roles.actualizar');

    });

    Route::prefix('admin')->middleware('auth')->group(function () {
        Route::get('/activity', [ActivityController::class, 'index'])->name('admin.activity.index');
        Route::get('/activity/{activity}', [ActivityController::class, 'show'])->name('admin.activity.show');

    });

    Route::get('/shoplive', [ShopliveController::class, 'index']);

});

