<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartyInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('party_info', function (Blueprint $table) {
            $table->id('p_id');
            $table->timestamps();
            $table->string('event_type');
            $table->string('event_theme');
            $table->time('event_time');
            $table->date('event_date');
            $table->string('event_venue');

            $table->foreignID('u_id')->unsigned();
            
            $table->foreign('u_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('party_info');
    }
}
