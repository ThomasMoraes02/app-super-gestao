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
        Schema::create('filiais', function (Blueprint $table) {
            $table->id();
            $table->string('filial', 50);
            $table->timestamps();
        });

        Schema::create('produto_filiais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('filial_id');
            $table->unsignedBigInteger('produto_id');
            
            $table->decimal('preco_venda', 8, 2);
            $table->decimal('estoque_minimo', 8,2);
            $table->decimal('estoque_maximo', 8,2);
            $table->timestamps();

            $table->foreign('filial_id')->references('id')->on('filiais');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });

        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('preco_venda', 'estoque_minimo', 'estoque_maximo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->decimal('preco_venda', 8, 2);
            $table->decimal('estoque_minimo', 8,2);
            $table->decimal('estoque_maximo', 8,2);
        });

        Schema::table('produto_filiais', function (Blueprint $table) {
            $table->dropForeign('produto_filiais_filial_id_foreign');
            $table->dropForeign('produto_filiais_produto_id_foreign');
            $table->dropColumn('filial_id');
            $table->dropColumn('produto_id');
        });

        Schema::dropIfExists('produto_filiais');
        Schema::dropIfExists('filiais');
    }
};
