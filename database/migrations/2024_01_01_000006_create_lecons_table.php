<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lecons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained()->cascadeOnDelete();
            $table->string('titre');
            $table->longText('contenu')->nullable();
            $table->enum('type', ['texte', 'video', 'fichier'])->default('texte');
            $table->string('url_media')->nullable();
            $table->unsignedSmallInteger('duree_minutes')->default(30);
            $table->unsignedTinyInteger('ordre')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('lecons'); }
};
