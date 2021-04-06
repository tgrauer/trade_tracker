<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyInTrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->foreignId('broker_id')->nullable()->constrained();
        });

        DB::statement('UPDATE trades SET broker_id = broker');

        Schema::table('trades', function (Blueprint $table) {
            $table->dropColumn('broker');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->smallInteger('broker')->nullable();
        });

        DB::statement('UPDATE trades SET broker = broker_id');

        Schema::table('trades', function (Blueprint $table) {
            $table->dropColumn('broker_id');
        });
    }
}
