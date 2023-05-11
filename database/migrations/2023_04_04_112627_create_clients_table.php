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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('ragione_sociale', '64');
            $table->string('partita_iva', '11')->unique()->nullable();
            $table->string('codice_fiscale', '16')->unique()->nullable();
            $table->string('sdi', '7');
            $table->string('pec');
            $table->string('sede_legale');
            $table->string('city');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
