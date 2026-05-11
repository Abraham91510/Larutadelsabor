<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('cliente_id');

            $table->string('folio');

            $table->decimal('subtotal',10,2);

            $table->decimal('descuento',10,2)->default(0);

            $table->decimal('total',10,2);

            $table->string('estado')->default('pendiente');

            $table->text('nota')->nullable();

            $table->string('qr')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};