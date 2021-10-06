<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestBarcode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_barcode', function (Blueprint $table) {
            $table->id('q_id');
            $table->timestamps();
            $table->string('hash');
            $table->foreignID('g_id')->unsigned();
            
            $table->foreign('g_id')->references('g_id')->on('party_guest');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_barcode');
    }
}
