<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('conoce_mas', function (Blueprint $table) {
        $table->id();
        $table->string('clave'); // enlace_inicio, enlace_registro, etc
        $table->string('icono');
        $table->string('texto');
        $table->string('url');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('enlaces_conoce_mas');
    }
};