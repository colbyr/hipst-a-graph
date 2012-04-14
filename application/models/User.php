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
     * @return bool
     */
    public function sync_api()
    {
        $oauth = OauthHelper::authed($this->oauth_token, $this->oauth_token_secret);
        try {
            $data = $oauth->fetch("http://openapi.etsy.com/v2/users/__SELF__", null, OAUTH_HTTP_METHOD_GET);
            $json = $oauth->getLastResponse();
            $res = json_decode($json, true);
            $res = $res['results'][0];
            $this->user_id = $res['user_id'];
            $this->login_name = $res['login_name'];
            $this->primary_email = $res['primary_email'];
            return true;
        } catch (OAuthException $e) {
            Log::error($e->getMessage());
            Log::error(print_r($oauth->getLastResponse(), true));
            Log::error(print_r($oauth->getLastResponseInfo(), true));
            return false;
        }
    }

}