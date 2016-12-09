<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_role_permission', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('role_id')->unsigned()->index()->nullable();
            $table->foreign('role_id')->references('id')->on('tbl_role');

            $table->integer('permission_id')->unsigned()->index()->nullable();    
            $table->foreign('permission_id')->references('id')->on('tbl_permission');    

            $table->string('value')->default('');
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
        Schema::dropIfExists('tbl_role_permission');
    }
}
