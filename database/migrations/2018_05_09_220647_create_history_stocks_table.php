<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('stock_id');
            $table->date('date')->nullable();
            $table->decimal('closed', 4, 2)->nullable();
            $table->decimal('min', 4, 2)->nullable();
            $table->decimal('max', 4, 2)->nullable();
            $table->decimal('var', 4, 2)->nullable()->comment('Variaçao em valor R$');
            $table->decimal('var_percent', 4, 2)->nullable()->comment('variaçao percentual');
            $table->timestamps();
            $table->unique(['stock_id', 'date']);
            $table->index(['stock_id', 'date']);
            $table->foreign('stock_id')->references('id')->on('stocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_stocks', function (Blueprint $table) {
            $table->dropForeign(['stock_id']);
        });
        Schema::dropIfExists('history_stocks');
    }
}
