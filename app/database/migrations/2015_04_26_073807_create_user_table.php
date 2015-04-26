<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_prueba', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password')->nullable();
			$table->string('name')->nullable();
			$table->string('birthday')->nullable();
			$table->string('photo')->nullable();
			$table->bigInteger('uid_fb')->nullable();
			$table->string('access_token_fb')->nullable();
			$table->string('remember_token')->nullable();
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
		Schema::drop('users_prueba');
	}

}
