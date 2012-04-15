<?php

class Add_More_User_Data {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function ($table) {
			$table->string('first_name');
			$table->string('last_name');
			$table->string('gender');
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
			$table->drop_column('first_name');
			$table->drop_column('last_name');
			$table->drop_column('gender');
		});
	}

}