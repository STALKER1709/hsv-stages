<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stagiaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pole_id')->nullable()->constrained()->nullOnDelete();
            $table->string('etablissement', 20)->default('AUTRE');
            $table->string('etablissement_autre')->nullable();
            $table->string('filiere');
            $table->string('niveau', 5);
            $table->enum('statut', ['en_attente', 'valide', 'refuse'])->default('en_attente');
            $table->string('numero_stagiaire', 20)->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('stagiaires'); }
};
