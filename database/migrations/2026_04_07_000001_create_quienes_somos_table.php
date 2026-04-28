<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quienes_somos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // mision, vision, objetivo
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('icono')->nullable();
            $table->string('imagen')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quienes_somos');
    }
};