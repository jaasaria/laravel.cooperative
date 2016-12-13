<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_messages', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('sender_Id')->unsigned()->index()->nullable();
            $table->foreign('sender_Id')->references('id')->on('users');

            $table->integer('receiver_id')->unsigned()->index()->nullable();
            $table->foreign('receiver_id')->references('id')->on('users');

            $table->text('messages')->nullable();
            $table->integer('seen')->default(0);
            
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
        Schema::dropIfExists('tr_messages');
    }
}
