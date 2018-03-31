<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOilCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oil_card', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('oc_number',255);
            $table->string('web_account',255);
            $table->string('password',255);
            $table->string('oc_code',255);
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
        Schema::dropIfExists('oil_card');
    }
}
