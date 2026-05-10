<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cupones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->decimal('descuento', 8, 2);
            $table->enum('tipo', ['fijo','porcentaje']);
            $table->integer('usos')->default(0);
            $table->integer('uso_maximo')->nullable();
            $table->date('expira_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cupones');
    }
};