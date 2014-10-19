<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('videos', function(Blueprint $table){
	        $table->increments('id');
	        $table->string('path');
	        $table->string('name');
	        $table->string('introduction');
	        $table->unsignedInteger('user_id');
	        $table->unsignedInteger('view_count');
	        $table->unsignedInteger('comment_count');
	        $table->unsignedInteger('score');
	        $table->unsignedInteger('score_count');
	        $table->dateTime('publishTime');
	        $table->unsignedInteger('status');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('videos', function(Blueprint $table){
		    $table->drop();
		});
	}

}
