<?php

class Oauth_Controller extends Base_Controller {

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */
    public function get_index()
    {
        Bundle::start('oauth');

        $OAUTH = new Oauth(URL::home());
        $OAUTH->set_site("http://openapi.etsy.com/v2/", "eyy20g4fis76a8mypze6qqbo", "pb8e4h4awi");
        $OAUTH->auth_site = 'https://www.etsy.com/';
        $OAUTH->callback = 'oauth/callback';
        $OAUTH->authorize_path = 'oauth/signin';

        // fetch request token
        $OAUTH->get_request_token();
        // prompt the user
        $OAUTH->get_user_authorization();

        echo '<pre>';
        print_r($OAUTH); exit();

        //return View::make('home.login');
    }

    public function get_callback()
    {
        echo __FUNCTION__ . PHP_EOL;

        echo Input::get('oauth_token');
    }

}