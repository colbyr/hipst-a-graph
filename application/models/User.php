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

    public static function top()
    {
        return static::order_by('score', 'desc')->take(5)->get();
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
     * Name
     *
     * returns the User's first name and last initial if full is false
     * otherwise returns the User's full name
     *
     * @param  bool $full
     * @return string
     */
    public function name($full=false)
    {
        $name = $this->first_name;

        if(empty($this->last_name))
        {
            $name .= ' ' . ($full ? $this->last_name : Str::limit($this->last_name, 1, '') . '.');
        }

        if (empty($name))
        {
            $name = $this->login_name;
        }

        return $name;
    }

    /**
     * Profile Link 
     *
     * Get link to User's Etsy profile 
     *
     * @return string
     */
    public function profile_link($full=false)
    {
        return 'http://etsy.com/people/' . $this->login_name;
    }

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
            $data = Etsy::user();
            $profile = $data->results[0]->Profile;
            
            $this->user_id = $profile->user_id;
            $this->login_name = $profile->login_name;
            $this->primary_email = $data->results[0]->primary_email;
            $this->first_name = $profile->first_name;
            $this->last_name = $profile->last_name;
            $this->gender = $profile->gender;
            $this->avatar_url = $profile->image_url_75x75;
            return true;
        } catch (OAuthException $e) {
            Log::error($e->getMessage());
            Log::error(print_r($oauth->getLastResponse(), true));
            Log::error(print_r($oauth->getLastResponseInfo(), true));
            return false;
        }
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
