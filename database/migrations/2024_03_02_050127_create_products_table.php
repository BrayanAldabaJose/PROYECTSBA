<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            // Agregar campos para controlar el stock
            $table->id();
            $table->string('name')->comment('Nombre del producto');
            $table->string('code')->unique()->comment('Código del producto');
            $table->longText('description')->nullable()->comment('Descripción del producto');
            $table->integer('initial_stock')->default(0)->comment('Stock inicial del producto');
            $table->integer('current_stock')->default(0)->comment('Stock actual del producto');
            $table->timestamp('last_stock_change')->nullable()->comment('Último cambio de stock del producto');
            // Agregar campos de relación con categorías y proveedores
            $table->unsignedBigInteger('category_id')->comment('ID de la categoría del producto');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('provider_id')->comment('ID del proveedor del producto');
            $table->foreign('provider_id')->references('id')->on('providers');
            // Agregar campo de estado del producto
            $table->enum('status', ['ACTIVE', 'DEACTIVATED'])->default('ACTIVE')->comment('Estado del producto: ACTIVO o DESACTIVADO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('products');
    }
}
