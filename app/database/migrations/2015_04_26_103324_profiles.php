<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Profiles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nick_name')->nullable();
			$table->string('photo')->nullable();
			$table->string('birthday')->nullable();
			$table->integer('status')->unsigned();
			$table->bigInteger('uid_fb')->nullable();
			$table->string('access_token_fb')->nullable();
			$table->integer('user_id');
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
		Schema::drop('profiles');
	}

}
