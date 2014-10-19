<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrelationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('urelation', function (Blueprint $table) {
			$table->string('host');
			$table->string('friend');
			$table->string('group');
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
		Schema::table('urelation', function(Blueprint $table){
		    $table->drop();
		});
	}

}
