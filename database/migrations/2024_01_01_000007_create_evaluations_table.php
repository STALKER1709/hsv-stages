<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained()->cascadeOnDelete();
            $table->string('titre');
            $table->enum('type', ['qcm', 'projet', 'soutenance'])->default('qcm');
            $table->text('description')->nullable();
            $table->timestamp('date_debut')->nullable();
            $table->timestamp('date_fin')->nullable();
            $table->unsignedSmallInteger('duree_minutes')->default(60);
            $table->decimal('note_max', 5, 2)->default(20);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('evaluations'); }
};
