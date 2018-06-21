<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
          $table->increments('id');
          $table->float('amount', 8, 2)->default(0);
          $table->integer('category_id')->unsigned()->nullable();
          $table->foreign('category_id')->references('id')->on('categories');
          $table->index('category_id');
          $table->integer('creditor_account_id')->unsigned()->nullable();
          $table->foreign('creditor_account_id')->references('id')->on('accounts');
          $table->index('creditor_account_id');
          $table->integer('debitor_account_id')->unsigned()->nullable();
          $table->foreign('debitor_account_id')->references('id')->on('accounts');
          $table->index('debitor_account_id');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
