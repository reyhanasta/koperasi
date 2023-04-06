<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('account_id');
            $table->string('officer_id');
            $table->string('transaction_code');
            $table->enum('type',['saving','loan','repayment']);
            $table->integer('amount');
            $table->integer('last_balance');
            $table->string('desc');
            $table->enum('status',['successed','failed','pending']);
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
        Schema::dropIfExists('transaction_histories');
    }
}
