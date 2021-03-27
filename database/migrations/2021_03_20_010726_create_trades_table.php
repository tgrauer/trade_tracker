<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('ticker');
            $table->string('company_name');
            $table->string('trade_type');
            $table->decimal('purchase_price', 8, 2)->nullable();
            $table->smallInteger('numb_shares')->nullable();
            $table->string('option_type')->nullable();
            $table->decimal('strike_price', 8, 2)->nullable();
            $table->timestamp('expiration_date')->nullable();
            $table->timestamp('created_at');
        });

        Schema::table('trades', function($table){
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
        Schema::dropIfExists('trades');
    }
}
