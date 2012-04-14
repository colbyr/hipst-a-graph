<?php

class Oauth_Controller extends Base_Controller {

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */
    public function get_index()
    {
        //return View::make('home.login');
    }

    public function get_auth()
    {
        // instantiate the OAuth object
        // OAUTH_CONSUMER_KEY and OAUTH_CONSUMER_SECRET are constants holding your key and secret
        // and are always used when instantiating the OAuth object 
        $oauth = new OAuth("eyy20g4fis76a8mypze6qqbo", "pb8e4h4awi");

        // make an API request for your temporary credentials
        $req_token = $oauth->getRequestToken("http://openapi.etsy.com/v2/oauth/request_token?scope=email_r%20listings_r", 'http://localhost/hipst-a-graph/public/oauth/callback');


        Session::flash('request_secret', $req_token['oauth_token_secret']);

        return Redirect::to($req_token['login_url']);
    }

    public function get_callback()
    {
        echo __FUNCTION__ . PHP_EOL;


        // get temporary credentials from the url
        $request_token = Input::get('oauth_token');

        // get the temporary credentials secret - this assumes you set the request secret  
        // in a cookie, but you may also set it in a database or elsewhere
        $request_token_secret = Session::get('request_secret');

        // get the verifier from the url
        $verifier = Input::get('oauth_verifier');

        $oauth = static::oauth();

        // set the temporary credentials and secret
        $oauth->setToken($request_token, $request_token_secret);

        try {
            // set the verifier and request Etsy's token credentials url
            $acc_token = $oauth->getAccessToken("http://openapi.etsy.com/v2/oauth/access_token", null, $verifier);
            echo 'got it' . PHP_EOL;
            print_r($acc_token);
        } catch (OAuthException $e) {
            echo($e->getMessage());
        }
        
    }

    public static function oauth()
    {
        $oauth = new OAuth("eyy20g4fis76a8mypze6qqbo", "pb8e4h4awi");
        return $oauth;
    }

}