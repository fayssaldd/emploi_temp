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
        Schema::create('seances', function (Blueprint $table) {
            $table->id();
            $table->foreignId("salle_id")->constrained("salles")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("formateur_id")->constrained("formateurs")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("group_id")->constrained("groups")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("color",255)->nullable();
            $table->enum("periode", [1,2,3,4]);
            $table->enum("jour", ["lundi","mardi","mercredi","jeudi","vendredi","samedi"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seances');
    }
};
