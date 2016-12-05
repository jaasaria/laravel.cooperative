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
            $table->string('trcode');
            
            $table->integer('supplier_id')->unsigned()->index()->nullable();
            $table->foreign('supplier_id')->references('id')->on('tbl_supplier');

            $table->date('datePurchase');
            $table->date('dateDelivery');
            $table->text('description')->nullable();
            $table->double('trsubtotal', 15, 4)->default(0);
            $table->double('trdiscount', 15, 4)->default(0);
            $table->double('trtotal', 15, 4)->default(0);

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
