<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pole_id')->constrained()->cascadeOnDelete();
            $table->foreignId('encadreur_id')->nullable()->constrained()->nullOnDelete();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('ordre')->default(1);
            $table->unsignedSmallInteger('duree_heures')->default(2);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('modules'); }
};
