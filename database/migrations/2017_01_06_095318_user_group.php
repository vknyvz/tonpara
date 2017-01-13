<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('user_group', function (Blueprint $table) {
        $table->increments('id')->index();
        $table->string('key')->index()->unique();
        $table->string('title');       
        $table->timestamps();
      });
      
      DB::table('user_group')->insert([
        ['title' => 'Süper Administratör', 'key' => 'super_admin'],
        ['title' => 'Administratör', 'key' => 'admin',],
        ['title' => 'Kullanıcı', 'key' => 'user',]
      ]);      
      
      Schema::create('user_group_rel', function (Blueprint $table) {
        $table->integer('user_id')->unsigned()->index();
        $table->integer('group_id')->unsigned()->index();
        
        $table->foreign('group_id')->references('id')->on('user_group')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
