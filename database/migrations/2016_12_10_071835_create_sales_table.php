<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('tr_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trcode')->unique();
            
            $table->integer('customer_id')->unsigned()->index()->nullable();
            $table->foreign('customer_id')->references('id')->on('tbl_customer');

            $table->date('dateSales');
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
        Schema::dropIfExists('tr_sales');
    }
}
