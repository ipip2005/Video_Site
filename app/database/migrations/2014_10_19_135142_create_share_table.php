<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('share', function (Blueprint $table) {
			$table->unsignedInteger('uid');
			$table->unsignedInteger('vid');
			$table->unsignedInteger('gid');
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
		Schema::table('share', function(Blueprint $table){
		    $table->drop();
		});
	}

}
