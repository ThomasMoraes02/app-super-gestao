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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->text('descricao')->nullable();
            $table->integer('quantidade');
            $table->integer('peso')->nullable();
            $table->decimal('preco_venda', 8, 2)->default(0.01);
            $table->decimal('estoque_minimo', 8,2)->default(1);
            $table->decimal('estoque_maximo', 8,2)->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
