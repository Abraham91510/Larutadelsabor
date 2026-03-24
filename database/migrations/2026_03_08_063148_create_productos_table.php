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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');

            // Slug para URL, ejemplo: bebidastormsinalcohol
            $table->string('slug');

            $table->text('descripcion');
            $table->decimal('precio', 8, 2);
            $table->float('rating')->default(4);
            $table->string('imagen');

            $table->string('icono')->default('bi-box');


            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('subcategoria_id');

            $table->timestamps();

            // Relaciones con otras tablas
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias');

            $table->foreign('subcategoria_id')
                ->references('id')
                ->on('subcategorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};