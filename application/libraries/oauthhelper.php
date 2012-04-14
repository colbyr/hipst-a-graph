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
        return new OAuth("eyy20g4fis76a8mypze6qqbo", "pb8e4h4awi");
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