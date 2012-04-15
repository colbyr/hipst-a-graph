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

    /**
     * Request Token
     *
     * Get a request token from the API
     *
     * @return array
     */
    public static function request_token()
    {
        $oauth = static::oauth();

        // make an API request for your temporary credentials
        $request_token = $oauth->getRequestToken(Config::get('oauth.url') . 'oauth/request_token', Config::get('oauth.callback'));

        return $request_token;
    }

    /**
     * Get query
     *
     * @param  string $query
     * @param  array  $params
     * @return array
     */
    public static function get($query, $params=array(), $user=null)
    {
        $user = is_null($user) ? Auth::user() : $user;
        $oauth = $user->oauth();
        try {
            $data = $oauth->fetch(Config::get('oauth.url') . $query, $params);
            $json = $oauth->getLastResponse();

            return json_decode($json);
            
        } catch (OAuthException $e) {
            print_r($e->getMessage());
            Log::error($e->getMessage());
            Log::error(print_r($oauth->getLastResponse(), true));
            Log::error(print_r($oauth->getLastResponseInfo(), true));
            exit;
        }
    }

}