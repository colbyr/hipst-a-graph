<?php

class Create_Requirements {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requirements', function($table){
		  $table->increments('id');
		  $table->string('noun');
		  $table->string('verb');
		  $table->string('value');
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
	     Schema::drop('requirements');
	}

}