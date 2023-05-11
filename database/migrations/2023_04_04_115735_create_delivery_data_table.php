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
        Schema::create('delivery_data', function (Blueprint $table) {
            $table->id();
            $table->string('sign');
            $table->string('address');
            $table->string('city');
            $table->text('note')->nullable();
            $table->string('reference_name');
            $table->string('telephone');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_data');
    }
};
