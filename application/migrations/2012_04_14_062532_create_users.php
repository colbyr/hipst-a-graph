<?php

class Create_Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
      Schema::create('users', function($table) {
        $table->increments('id');
        $table->string('oauth_token', 320);
        $table->string('oauth_token_secret', 320);
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
