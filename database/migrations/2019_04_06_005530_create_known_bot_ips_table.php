<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnownBotIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'bothound_ips', function ( Blueprint $table )
        {
            $table->bigIncrements( 'id' );
            $table->string( 'ip', 16 )->index();
            $table->string( 'network', 16 )->default( 'facebook' );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'bothound_ips' );
    }
}
