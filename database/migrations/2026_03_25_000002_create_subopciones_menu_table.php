<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('subopciones_menu', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('opcion_id');

            $table->string('nombre');

            $table->string('url');

            $table->string('icono')->nullable();

            $table->integer('orden')->default(0);

            $table->timestamps();

            // Relación
            $table->foreign('opcion_id')
                  ->references('id')
                  ->on('opciones_menu')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('subopciones_menu');
    }
};