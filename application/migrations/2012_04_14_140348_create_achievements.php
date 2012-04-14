<?php

class Create_Achievements {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
      Schema::create('achievements', function($table) {
        $table->increments('id');
        $table->string('name', 255)->unique();
        $table->float('value');
        $table->text('description');
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
		Schema::drop('users');
	}

}