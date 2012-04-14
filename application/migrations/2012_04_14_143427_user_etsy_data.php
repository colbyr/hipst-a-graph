<?php

class User_Etsy_Data {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function ($table) {
			$table->integer('user_id')->index();
			$table->string('login_name')->index();
			$table->string('email')->index();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function ($table) {
			$table->drop_column('user_id');
			$table->drop_column('login_name');
			$table->drop_column('email');
		});
	}

}