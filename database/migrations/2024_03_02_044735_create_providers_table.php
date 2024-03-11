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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email');
            $table->string('ruc_number');
            $table->string('address')->nullable();
            $table->string('phone');
            $table->string('camera_type'); // Nuevo campo: Tipo de cámaras
            $table->string('origin_country'); // Nuevo campo: País de Origen
            $table->string('latin_american_countries'); // Nuevo campo: Países de Latinoamérica con oficinas
            $table->string('main_link'); // Nuevo campo: Link principal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
