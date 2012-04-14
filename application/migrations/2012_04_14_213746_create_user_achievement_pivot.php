<?php

class Create_User_Achievement_Pivot {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_achievement', function ($table) {
			$table->increments('id');
			$table->integer('user_id')->index();
			$table->integer('achievement_id')->index();
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_achievement');
	}

}