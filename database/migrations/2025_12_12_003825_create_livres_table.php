<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->foreignId('auteur_id')->constrained('auteurs')->cascadeOnDelete();
            $table->foreignId('categorie_id')->constrained('categories')->cascadeOnDelete();
            $table->date('date_publication')->nullable();
            $table->string('isbn')->nullable()->unique();
            $table->integer('nb_exemplaires')->default(1);
            $table->string('couverture_path')->nullable();
            $table->timestamps();
        });
    }
    public function down(){ Schema::dropIfExists('livres'); }
};
