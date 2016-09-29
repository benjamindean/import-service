<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            // Using MyISAM for faster search
            $table->engine = 'MyISAM';
            $table->increments('id');
            // Adding a unique index
            $table->integer('user_id')->unique();
            $table->string('name');
            $table->integer('age');
            $table->string('address');
            $table->string('team');
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
        Schema::drop('users');
    }
}
