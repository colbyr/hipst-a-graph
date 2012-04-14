<?php

class Create_Achievement_Id {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('requirements', function($table)
        {
            $table->integer('achievement_id');
        });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('requirements', function($table)
        {
            $table->drop_column('achievement_id');
        });
	}

}
