<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipos_de_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('icono');
            $table->string('color_icono');
            $table->string('titulo');
            $table->text('texto'); // Aquí guardaremos el HTML de la lista <ul>
            $table->string('bg_clase'); // Para el fondo bg-opacity-10
            $table->integer('orden');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos_de_servicios');
    }
};