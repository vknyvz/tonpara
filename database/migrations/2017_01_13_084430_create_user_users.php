<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('user_users_rel', function (Blueprint $table) {
        $table->increments('id')->index();
        $table->integer('admin_id')->unsigned()->index();
        $table->integer('user_id')->unsigned()->index();
        
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
        
        $table->unique(['admin_id', 'user_id']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}