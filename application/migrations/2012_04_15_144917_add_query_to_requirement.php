<?php

class Add_Query_To_Requirement {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('requirements', function ($table) {
			$table->string('query');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('requirements', function ($table) {
			$table->drop_column('query');
		});
	}

}