<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrStockOutDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('tr_stock_out_item', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('stockout_id')->unsigned()->index()->nullable();
            $table->foreign('stockout_id')->references('id')->on('tr_stock_out')->onDelete('cascade');

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
         Schema::dropIfExists('tr_stock_out_item');
    }
}
