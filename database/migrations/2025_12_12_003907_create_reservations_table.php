<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('livre_id')->constrained('livres')->cascadeOnDelete();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('statut', ['en_attente','validee','annulee'])->default('en_attente');
            $table->text('admin_comment')->nullable();
            $table->timestamps();
        });
    }
    public function down(){ Schema::dropIfExists('reservations'); }
};
