<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('porque_elegirnos', function (Blueprint $table) {
            $table->id();
            $table->string('icono');
            $table->string('color_icono');
            $table->string('titulo');
            $table->text('texto');
            $table->integer('orden')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('porque_elegirnos'); }
};