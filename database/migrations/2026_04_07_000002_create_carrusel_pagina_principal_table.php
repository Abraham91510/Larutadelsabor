<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carrusel_pagina_principal', function (Blueprint $table) {
            $table->id();

            $table->string('titulo');
            $table->text('texto')->nullable();
            $table->string('imagen')->nullable();
            $table->string('icono')->nullable();

            // 🔥 NUEVO
            $table->string('icono_color')->nullable();
            $table->string('icono_size')->nullable();

            $table->string('titulo_color')->nullable();
            $table->string('titulo_size')->nullable();

            $table->string('texto_color')->nullable();
            $table->string('texto_size')->nullable();

            $table->integer('orden')->default(0);
            $table->boolean('is_active')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrusel_pagina_principal');
    }
};