<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attestations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stagiaire_id')->constrained()->cascadeOnDelete();
            $table->string('numero', 30)->unique();
            $table->timestamp('generee_le')->nullable();
            $table->foreignId('validee_par')->nullable()->constrained('users')->nullOnDelete();
            $table->string('mention')->nullable();
            $table->string('fichier_pdf')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('attestations'); }
};
