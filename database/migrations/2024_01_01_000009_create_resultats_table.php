<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('resultats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stagiaire_id')->constrained()->cascadeOnDelete();
            $table->foreignId('evaluation_id')->constrained()->cascadeOnDelete();
            $table->decimal('score', 5, 2)->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamp('soumis_le')->nullable();
            $table->timestamps();
            $table->unique(['stagiaire_id', 'evaluation_id']);
        });
    }

    public function down(): void { Schema::dropIfExists('resultats'); }
};
