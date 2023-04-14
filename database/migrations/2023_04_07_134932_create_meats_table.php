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
        Schema::create('meats', function (Blueprint $table) {
            $table->id();
            $table->float('unit');
            $table->float('average_size');
            $table->float('pz_box');



            //same for all products
            $table->float('purchase_price');
            $table->float('b2b_price');
            $table->float('b2b_percentage');
            $table->float('b2d_price');
            $table->float('b2d_percentage');
            $table->float('b2c_price');
            $table->float('b2c_percentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meats');
    }
};
