<?php

/**
 * OauthHelper
 *
 * oauth factory... (sorry Thom)
 *
 * @author Colby Rabideau
 */
class OauthHelper
{

    /**
     * Oauth
     *
     * get default oauth object
     *
     * @return Oauth
     */
    public static function oauth()
    {
        return new OAuth(Config::get('oauth.keystring'), Config::get('oauth.secret'));
    }

    /**
     * Authed
     *
     * get oauth object for authorized user
     *
     * @param  string $token
     * @param  string $secret
     * @return Oauth
     */
    public static function authed($token, $secret)
    {
        $oauth = static::oauth();
        $oauth->setToken($token, $secret);
        return $oauth;
    }

}