<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tarjetas_cliente', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('cliente_id');

            $table->string('titular');

            $table->string('numero');

            $table->string('cvv');

            $table->string('expiracion');

            $table->decimal('saldo',10,2)->default(0);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tarjetas_cliente');
    }
};