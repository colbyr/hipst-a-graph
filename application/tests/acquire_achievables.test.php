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
		Command::run(array('acquireachievables'));
	}
}