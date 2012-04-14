<?php


class User extends Aware
{
    
    /**
     * Accessible
     *  for mass-assignment...
     */
    public static $accessable = array();

    /**
     * [Many to Many] Achievements
     * 
     * @return array
     */
    public function achievements()
    {
        $this -> has_many_and_belongs_to('Achievements');
    }

    /**
     * Aware Validation Rules
     *
     * @var array
     */
    public static $rules = array ();

    /**
     * API
     *
     * get the use data from the api
     *
     * @return void
     */
    public function api()
    {
        $oauth = OauthHelper::authed($this->oauth_token, $this->oauth_token_secret);
        try {
            $data = $oauth->fetch("http://openapi.etsy.com/v2/users/__SELF__", null, OAUTH_HTTP_METHOD_GET);
            $json = $oauth->getLastResponse();
            echo '<pre>';
            print_r(json_decode($json, true));
            exit();
        } catch (OAuthException $e) {
            error_log($e->getMessage());
            error_log(print_r($oauth->getLastResponse(), true));
            error_log(print_r($oauth->getLastResponseInfo(), true));
            exit;
        }
    }

}