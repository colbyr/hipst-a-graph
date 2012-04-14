<?php

class Login_Controller extends Base_Controller {

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */

    public function action_index()
    {
        return View::make('home.login');
    }

}