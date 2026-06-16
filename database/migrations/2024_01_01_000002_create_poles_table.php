<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('poles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('couleur', 20)->default('blue');
            $table->string('icone', 50)->default('fa-code');
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('poles'); }
};
