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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre de la moneda
            $table->string('code'); // Código de la moneda
            $table->string('symbol')->nullable(); // Símbolo de la moneda
            $table->string('country')->nullable(); // País o región donde se utiliza la moneda
            $table->decimal('exchange_rate', 12, 4)->default(1.0); // Tasa de cambio
            $table->string('origin_country')->nullable(); // País de origen de la moneda
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
