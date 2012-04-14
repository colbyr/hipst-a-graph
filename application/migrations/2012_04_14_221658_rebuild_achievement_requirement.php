<?php

class Rebuild_Achievement_Requirement {

/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('achievement_requirement', function ($table) {
			$table->increments('id');
			$table->integer('achievement_id')->index();
			$table->integer('requirement_id')->index();
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
		Schema::drop('achievement_requirement');
	}

}