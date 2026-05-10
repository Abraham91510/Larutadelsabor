<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('producto_caracteristicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained()->cascadeOnDelete();
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('producto_caracteristicas');
    }
};