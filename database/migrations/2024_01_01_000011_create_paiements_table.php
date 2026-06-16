<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stagiaire_id')->constrained()->cascadeOnDelete();
            $table->decimal('montant', 10, 0)->default(50000);
            $table->enum('methode', ['orange_money', 'mtn_momo', 'especes']);
            $table->enum('statut', ['en_attente', 'valide', 'refuse'])->default('en_attente');
            $table->string('reference', 50)->nullable();
            $table->string('numero_telephone', 20)->nullable();
            $table->timestamp('valide_le')->nullable();
            $table->foreignId('valide_par')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('paiements'); }
};
