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
        //CLIENT
        Schema::table('clients', function (Blueprint $table) {
            $table->foreignId('client_type_id')
                ->constrained();
            $table->foreignId('pricing_type_id')
                ->constrained();
            $table->foreignId('city_id')
                ->constrained();
            $table->foreignId('province_id')
                ->constrained();
            $table->foreignId('region_id')
                ->constrained();
        });

        //DELIVERY_DATA
        Schema::table('delivery_data', function (Blueprint $table) {
            $table->foreignId('city_id')
                ->constrained();
            $table->foreignId('province_id')
                ->constrained();
            $table->foreignId('region_id')
                ->constrained();
            $table->foreignId('client_id')
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //CLIENT
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['client_type_id']);
            $table->dropForeign(['pricing_type_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['province_id']);
            $table->dropForeign(['region_id']);
        });

        //DELIVERY_DATA
        Schema::table('delivery_data', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['province_id']);
            $table->dropForeign(['region_id']);
            $table->dropForeign(['client_id']);
        });
    }
};
