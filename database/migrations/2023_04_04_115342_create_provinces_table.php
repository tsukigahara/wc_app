<?php

use App\Models\Province;
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
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('shorthand');
        });

        $provinceItaliane = array(
            "AG" => "Agrigento",
            "AL" => "Alessandria",
            "AN" => "Ancona",
            "AO" => "Aosta",
            "AR" => "Arezzo",
            "AP" => "Ascoli Piceno",
            "AT" => "Asti",
            "AV" => "Avellino",
            "BA" => "Bari",
            "BT" => "Barletta-Andria-Trani",
            "BL" => "Belluno",
            "BN" => "Benevento",
            "BG" => "Bergamo",
            "BI" => "Biella",
            "BO" => "Bologna",
            "BZ" => "Bolzano",
            "BS" => "Brescia",
            "BR" => "Brindisi",
            "CA" => "Cagliari",
            "CL" => "Caltanissetta",
            "CB" => "Campobasso",
            "CI" => "Carbonia-Iglesias",
            "CE" => "Caserta",
            "CT" => "Catania",
            "CZ" => "Catanzaro",
            "CH" => "Chieti",
            "CO" => "Como",
            "CS" => "Cosenza",
            "CR" => "Cremona",
            "KR" => "Crotone",
            "CN" => "Cuneo",
            "EN" => "Enna",
            "FM" => "Fermo",
            "FE" => "Ferrara",
            "FI" => "Firenze",
            "FG" => "Foggia",
            "FC" => "Forlì-Cesena",
            "FR" => "Frosinone",
            "GE" => "Genova",
            "GO" => "Gorizia",
            "GR" => "Grosseto",
            "IM" => "Imperia",
            "IS" => "Isernia",
            "AQ" => "L'Aquila",
            "SP" => "La Spezia",
            "LT" => "Latina",
            "LE" => "Lecce",
            "LC" => "Lecco",
            "LI" => "Livorno",
            "LO" => "Lodi",
            "LU" => "Lucca",
            "MC" => "Macerata",
            "MN" => "Mantova",
            "MS" => "Massa-Carrara",
            "MT" => "Matera",
            "ME" => "Messina",
            "MI" => "Milano",
            "MO" => "Modena",
            "MB" => "Monza e della Brianza",
            "NA" => "Napoli",
            "NO" => "Novara",
            "NU" => "Nuoro",
            "OG" => "Ogliastra",
            "OT" => "Olbia-Tempio",
            "OR" => "Oristano",
            "PD" => "Padova",
            "PA" => "Palermo",
            "PR" => "Parma",
            "PV" => "Pavia",
            "PG" => "Perugia",
            "PU" => "Pesaro e Urbino",
            "PE" => "Pescara",
            "PC" => "Piacenza",
            "PI" => "Pisa",
        );

        foreach ($provinceItaliane as $key => $province) {
            $n = new Province();
            $n->name = $province;
            $n->shorthand = $key;
            $n->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
