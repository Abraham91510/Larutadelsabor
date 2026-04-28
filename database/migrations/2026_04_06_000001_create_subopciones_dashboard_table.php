<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('subopciones_dashboard', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opcion_id');
            $table->string('nombre');
            $table->string('url');
            $table->string('icono')->nullable();
            $table->integer('orden')->default(0);
            $table->string('role')->default('admin'); 
            $table->timestamps();

            $table->foreign('opcion_id')
                  ->references('id')
                  ->on('opciones_dashboard')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subopciones_dashboard');
    }
};