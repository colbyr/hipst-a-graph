<?php

class Login_Controller extends Base_Controller {

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */
    public function action_index()
    {
        Bundle::start('oauth');
        $OAUTH = new Oauth("http://your_apps_url_here.com");
        return View::make('home.login');
    }

}