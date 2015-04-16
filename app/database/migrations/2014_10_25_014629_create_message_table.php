<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('message', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('to_id')->unsigned();
			$table->foreign('to_id')->references('id')->on('users');
			$table->integer('from_id')->unsigned();
			$table->foreign('from_id')->references('id')->on('users');
			$table->string('message');
			$table->string('title');
			$table->boolean('is_read');
			$table->boolean('is_sent');
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
		Schema::drop('message');
	}

}
