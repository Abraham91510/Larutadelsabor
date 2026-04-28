<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('datos_empresa', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_empresa');
            $table->string('eslogan_empresa')->nullable();
            $table->string('logo_empresa')->nullable();
            $table->text('descripcion_empresa')->nullable();

            // 👇 AQUÍ guardamos tu array tal cual
            $table->json('derechos_reservados_empresa')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('datos_empresa');
    }
};