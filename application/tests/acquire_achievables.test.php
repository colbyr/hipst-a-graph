<?php
use Laravel\CLI\Command;
require path('sys').'cli/dependencies'.EXT;

class TestAcquire_Achievables extends PHPUnit_Framework_TestCase {

	protected $a;
	protected $require;

	// protected function setUp()
	// {
		//
	// }

	// protected fuction tearDown()
	// {
		//
	// }

	// public function testGetAchievements()
	// {
		//
	// }

	public function testRun()
	{
		//pass in a user with Auth::user() as a parameter
		Command::run(array('acquireachievables ' . Auth::user()));
	}

	public function TestAcquire()
	{
		 $user = Auth::user();
		 $achievements = $user->achievements;
		 assert(count($achievements) > -1);
	}

}