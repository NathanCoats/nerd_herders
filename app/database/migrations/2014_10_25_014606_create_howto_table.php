<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHowtoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('howto', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('type');
			$table->string('description');
			$table->string('instructions');
			$table->string('poster_id');
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
		Schema::drop('howto');
	}

}
