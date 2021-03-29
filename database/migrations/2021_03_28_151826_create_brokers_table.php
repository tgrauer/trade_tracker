<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brokers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        // Insert some stuff
        DB::table('brokers')->insert(
            array(
                ['name' => 'Ally Invest'],
                ['name' => 'Charles Schwab'],
                ['name' => 'E-Trade'],
                ['name' => 'Fidelity'],
                ['name' => 'Interactive Brokers'],
                ['name' => 'Lightspeed'],
                ['name' => 'Merrill Edge'],
                ['name' => 'Robinhood'],
                ['name' => 'TD Ameritrade'],
                ['name' => 'TradeStation'],
                ['name' => 'Vanguard'],
                ['name' => 'Webull']
            )
        );

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brokers');
    }
}
