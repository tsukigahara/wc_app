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
            $table->foreignId('province_id')
                ->constrained();
            $table->foreignId('region_id')
                ->constrained();
        });

        //DELIVERY_DATA
        Schema::table('delivery_data', function (Blueprint $table) {
            $table->foreignId('province_id')
                ->constrained();
            $table->foreignId('region_id')
                ->constrained();
            $table->foreignId('client_id')
                ->constrained();
        });

        //MEATS
        Schema::table('meats', function (Blueprint $table) {
            $table->foreignId('BMS_id')
                ->constrained('BMSs');
            $table->foreignId('brand_id')
                ->constrained();
        });

        // //PRODUCT_SUPPLIER
        // Schema::table('product_supplier', function (Blueprint $table) {
        //     $table->foreignId('product_id')
        //         ->constrained();
        //     $table->foreignId('supplier_id')
        //         ->constrained();
        // });

        //SUPPLIER
        Schema::table('suppliers', function (Blueprint $table) {
            $table->foreignId('state_id')
                ->constrained();
        });

        //MEAT_MEAT_SUBNAME
        Schema::table('meat_meat_subname', function (Blueprint $table) {
            $table->foreignId('meat_id')
                ->constrained();
            $table->foreignId('meat_subnames_id')
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
            $table->dropForeign(['province_id']);
            $table->dropForeign(['region_id']);
        });

        //DELIVERY_DATA
        Schema::table('delivery_data', function (Blueprint $table) {
            $table->dropForeign(['province_id']);
            $table->dropForeign(['region_id']);
            $table->dropForeign(['client_id']);
        });

        //MEATS
        Schema::table('meats', function (Blueprint $table) {
            $table->dropForeign(['BMS_id']);
            $table->dropForeign(['brand_id']);
        });

        // //PRODUCT_SUPPLIER
        // Schema::table('product_supplier', function (Blueprint $table) {
        //     $table->dropForeign(['product_id']);
        //     $table->dropForeign(['supplier_id']);
        // });

        //SUPPLIER
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
        });

        //MEAT_MEAT_SUBNAME
        Schema::table('meat_meat_subname', function (Blueprint $table) {
            $table->dropForeign(['meat_id']);
            $table->dropForeign(['meat_subnames_id']);
        });
    }
};
