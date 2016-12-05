<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_purchasesItem', function (Blueprint $table) {
            $table->increments('id');

            
            $table->integer('purchase_id')->unsigned()->index()->nullable();
            $table->foreign('purchase_id')->references('id')->on('tr_purchases')->onDelete('cascade');

            $table->integer('item_id')->unsigned()->index()->nullable();
            $table->foreign('item_id')->references('id')->on('tbl_item');

            $table->double('qty', 15, 4)->default(0);
            $table->double('cost', 15, 4)->default(0);
            $table->double('subtotal', 15, 4)->default(0);

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
        Schema::dropIfExists('tr_purchasesItem');
    }
}
