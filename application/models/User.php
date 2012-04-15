<?php


class User extends Aware
{
    
    /**
     * Accessible
     *  for mass-assignment...
     */
    public static $accessable = array('username', 'password');

    /**
     * [Many to Many] Achievements
     * 
     * @return array
     */
    public function achievements()
    {
        return $this->has_many_and_belongs_to('Achievement');
    }

    /**
     * Aware Validation Rules
     *
     * @var array
     */
    // public static $rules = array(
            // 'username' => 'required',
            // 'password' => 'required|min:6'
        // );

    /**
     * Sync API
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
            $this->sync_avatar();
            return true;
        } catch (OAuthException $e) {
            Log::error($e->getMessage());
            Log::error(print_r($oauth->getLastResponse(), true));
            Log::error(print_r($oauth->getLastResponseInfo(), true));
            return false;
        }
    }

    /**
     * Sync Avatar
     *
     * get the user avatar URL
     *
     * @return void
     */
    public function sync_avatar()
    {
        $res = Etsy::avatar();
        $this->avatar_url = $res->results->src;
    }

    /**
     * Oauth 
     *
     * Get an oauth object for this user
     *
     * @return Oauth
     */
    public function oauth()
    {
        return OauthHelper::authed($this->oauth_token, $this->oauth_token_secret);
    }

    /**
     * Check and Hash new password
     *
     * @return void
     */
    public function checkAndHash()
    {
        // if there's a new password, hash it
        if($this->changed('password'))
        {
            $this->set_password(Hash::make($this->password));
        }
    }
    /**
     * onSave
     *
     * @return bool
     */
    public function onSave()
    {
        $this->checkAndHash();
        return parent::onSave();
    }
    /**
     * onForceSave
     *
     * @return bool
     */
    public function onForceSave()
    {
        $this->checkAndHash();
        return parent::onForceSave();
    }

}
