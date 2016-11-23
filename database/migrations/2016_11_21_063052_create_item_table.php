<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_item', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code');
            $table->string('name');
            $table->double('cost', 15, 4)->default(0);
            $table->double('price', 15, 4)->default(0);
            $table->double('qty', 15, 4)->default(0);
            $table->double('tax', 15, 4)->default(0);

            $table->integer('unit_id')->unsigned()->index()->nullable();
            $table->foreign('unit_id')->references('id')->on('tbl_units');

            $table->integer('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('tbl_categories');

            $table->string('barcode')->default('');
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
        Schema::dropIfExists('tbl_item');
    }
}
