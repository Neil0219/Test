<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartyGuestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('party_guest', function (Blueprint $table) {
            $table->id('g_id');
            $table->timestamps();
            $table->string('name');
            $table->string('gender');
            $table->string('contact_num');
            $table->string('email');
            $table->string('role');
            $table->foreignID('p_id')->unsigned();
            
            $table->foreign('p_id')->references('p_id')->on('party_info');
            //$table->string('barcode')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('party_guest', function (Blueprint $table) {
            $table->dropForeign(['p_id']);
            $table->dropColumn('p_id');
          });
    }
}
