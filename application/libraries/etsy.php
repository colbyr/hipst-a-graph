<?php

/**
 * Etsy
 * 
 * Class for manipulating the Etsy API
 *
 */
class Etsy
{

    /**
     * Active
     *  get active listings
     *
     * @return array
     */
    public static function active()
    {
        return static::get('/listings/active');
    }

    /**
     * Favorites
     *  get favorites for the current user
     *
     * @return array
     */
    public static function favorites()
    {
        return static::get('/users/__SELF__/favorites/listings');
    }

    /**
     * Get query
     *
     * @param  string $query
     * @return array
     */
    public static function get($query)
    {
        $oauth = Auth::user()->oauth();
        try {
            $data = $oauth->fetch("http://openapi.etsy.com/v2/" . $query);
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