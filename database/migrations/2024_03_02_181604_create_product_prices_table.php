<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->comment('ID del producto al que pertenece el precio');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->decimal('amount', 12, 2)->comment('Cantidad del producto en el lote');
            $table->decimal('unit_price', 10, 2)->comment('Precio unitario del producto');
            $table->decimal('base_price', 10, 2)->comment('Precio base del producto')->nullable(); // Agrega el campo base_price
            $table->unsignedBigInteger('currency_id')->comment('ID de la moneda utilizada para el precio');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->decimal('discount', 5, 2)->default(0)->comment('Descuento aplicado al precio');
            $table->unsignedBigInteger('tax_id')->nullable()->comment('ID del impuesto aplicado al precio');
            $table->foreign('tax_id')->references('id')->on('taxes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};
