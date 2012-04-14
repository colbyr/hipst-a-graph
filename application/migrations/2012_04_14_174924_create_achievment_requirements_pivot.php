<?php

class Create_Achievment_Requirements_Pivot {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('achievements_requirements', function ($table) {
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
		Schema::drop('achievements_requirements');
	}

}