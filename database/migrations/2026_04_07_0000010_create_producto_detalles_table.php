<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('producto_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained()->cascadeOnDelete();
            $table->text('descripcion')->nullable();
            $table->text('ingredientes')->nullable();
            $table->text('nutricional')->nullable();
            $table->text('advertencias')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('producto_detalles');
    }
};