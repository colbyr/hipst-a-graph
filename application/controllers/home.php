<?php

class Home_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	*/

	public function get_index()
	{
		return View::make('home.index')->with('top_users', User::top());
	}

}