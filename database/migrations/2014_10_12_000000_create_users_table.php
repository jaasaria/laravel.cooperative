<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->string('avatar')->default('default.png');
            $table->text('notes')->nullable();

            $table->string('email')->unique();
            $table->string('password');
            $table->string('token')->nullable();
            $table->string('verified')->default(0);
            $table->string('active')->default(1);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
