<?php

use App\Models\PricingType;
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
        Schema::create('pricing_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('percentage');
        });

        $names = [
            'b2b' => '5',
            'b2d' => '8',
            'b2c' => '10',
        ];
        foreach ($names as $key => $name) {
            $n = new PricingType;
            $n->name = $key;
            $n->percentage = $name;
            $n->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_types');
    }
};
