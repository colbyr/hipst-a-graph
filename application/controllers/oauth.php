<?php

class Oauth_Controller extends Base_Controller {

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */

    public function __construct()
    {

        // auth
        $this->filter('before', 'auth');

        // oauth
        $this->filter('before', 'oauthed');

        parent::__construct();
    }

    /**
     * [GET] Index
     *
     * @return View
     */
    public function get_index()
    {
        return View::make('home.oauth');
    }

    /**
     * [GET] Auth
     *
     * @return Redirect
     */
    public function get_auth()
    {
        // make an API request for your temporary credentials
        $token = OauthHelper::request_token();

        // flash the toke to the session data
        Session::flash('request_secret', $token['oauth_token_secret']);

        // redirect to login
        return Redirect::to($token['login_url']);
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
            $user = Auth::user();
            $user->oauth_token = $acc_token['oauth_token'];
            $user->oauth_token_secret = $acc_token['oauth_token_secret'];

            if ($user->sync_api()) {
                echo 'saved';
                $user->save();
                return Redirect::to('user/profile');
            }
        } catch (OAuthException $e) {
            echo($e->getMessage());
        }       
    }

}