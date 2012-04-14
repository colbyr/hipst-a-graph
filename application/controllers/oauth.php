<?php

class Oauth_Controller extends Base_Controller {

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */

    /**
     * [GET] Index
     *
     * @return View
     */
    public function get_index()
    {

        return View::make('home.login');
    }

    /**
     * [GET] Auth
     *
     * @return Redirect
     */
    public function get_auth()
    {
        // instantiate the OAuth object
        // OAUTH_CONSUMER_KEY and OAUTH_CONSUMER_SECRET are constants holding your key and secret
        // and are always used when instantiating the OAuth object 
        $oauth = OauthHelper::oauth();

        // make an API request for your temporary credentials
        $req_token = $oauth->getRequestToken("http://openapi.etsy.com/v2/oauth/request_token", 'http://localhost/hipst-a-graph/public/oauth/callback');


        Session::flash('request_secret', $req_token['oauth_token_secret']);

        return Redirect::to($req_token['login_url']);
    }

    /**
     * [GET] Callback
     *
     * @return Redirect
     */
    public function get_callback()
    {
        // get temporary credentials from the url
        $request_token = Input::get('oauth_token');

        // get the temporary credentials secret - this assumes you set the request secret  
        // in a cookie, but you may also set it in a database or elsewhere
        $request_token_secret = Session::get('request_secret');

        // get the verifier from the url
        $verifier = Input::get('oauth_verifier');

        $oauth = OauthHelper::authed($request_token, $request_token_secret);

        try {
            // set the verifier and request Etsy's token credentials url
            $acc_token = $oauth->getAccessToken("http://openapi.etsy.com/v2/oauth/access_token", null, $verifier);
            $user = new User();
            $user->oauth_token = $acc_token['oauth_token'];
            $user->oauth_token_secret = $acc_token['oauth_token_secret'];
            $user->save();

            $user->api();
            echo '<pre>';
            print_r($user); exit();
        } catch (OAuthException $e) {
            echo($e->getMessage());
        }       
    }

}