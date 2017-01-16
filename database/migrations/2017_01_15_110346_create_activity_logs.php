<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('activity_logs', function (Blueprint $table) {
        $table->increments('id')->index();
        $table->enum('activity', ['user_register', 'user_updated', 'user_loggedin', 'user_bind', 'user_unbind'])->default(null)->nullable()->index();
        $table->integer('created_by')->unsigned()->index();
        $table->text('payload')->nullable();
        
        $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        //
    }
}
