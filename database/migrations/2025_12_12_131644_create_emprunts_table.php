<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('emprunts', function (Blueprint $table) {
        $table->id();
        
        $table->foreignId('livre_id')->constrained()->cascadeOnDelete();
        $table->foreignId('emprunteur_id')->constrained()->cascadeOnDelete();

        $table->date('date_emprunt');
        $table->date('date_retour')->nullable();

        $table->string('etat')->default('en_cours'); // en_cours / rendu / en_retard

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprunts');
    }
};
