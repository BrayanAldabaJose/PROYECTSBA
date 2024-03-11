<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToProvidersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->string('camera_type')->after('phone');
            $table->string('origin_country')->after('camera_type');
            $table->string('latin_american_countries')->after('origin_country');
            $table->string('main_link')->after('latin_american_countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->dropColumn('camera_type');
            $table->dropColumn('origin_country');
            $table->dropColumn('latin_american_countries');
            $table->dropColumn('main_link');
        });
    }
}
