<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarteiraAcoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carteira_acoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->char('tipo', 1)->comment('C=compra, V=venda');
            $table->unsignedInteger('acao_id');
            $table->date('date');
            $table->integer('qtd');
            $table->decimal('preco', 7, 3);
            $table->decimal('taxa', 7, 3);
            $table->decimal('valor_operacao', 7, 3);
            $table->decimal('lucro', 7, 3)->nullable();
            $table->integer('qtd_atual');
            $table->decimal('pm_atual', 7, 3);
            $table->integer('qtd_anterior');
            $table->decimal('pm_anterior', 7, 3);
            $table->timestamps();
            $table->foreign('acao_id')->references('id')->on('stocks');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carteira_acoes', function (Blueprint $table) {
            $table->dropForeign(['acao_id']);
        });
        Schema::table('carteira_acoes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('carteira_acoes');
    }
}
