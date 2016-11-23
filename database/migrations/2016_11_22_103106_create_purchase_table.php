<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_purchases', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code');
            
            $table->integer('supplier_id')->unsigned()->index()->nullable();
            $table->foreign('supplier_id')->references('id')->on('tbl_supplier');

            $table->date('purchaseDate');
            $table->date('deliveryDate');

            $table->double('total', 15, 4)->default(0);

            $table->text('description')->nullable();
            $table->boolean('active')->default(false);

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
        Schema::dropIfExists('tr_purchases');
    }
}
