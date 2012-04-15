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
        return OauthHelper::get('/listings/active');
    }

    /**
     * Favorites
     *  get favorites for the current user
     *
     * @return array
     */
    public static function favorites($user=null)
    {
        $params = array(
                'fields'=>'listing_id',
                'includes'=>'Listing'
            );

        $response = OauthHelper::get(static::user_url($user) . 'favorites/listings', $params, $user);

        return static::flatten($response);
    }

    /**
     * Orders
     *  get orders associated with the current user
     *
     * @param  User
     * @return array
     */
    public static function orders($user=null)
    {
        return OauthHelper::get(static::user_url($user) . 'orders', array(), $user);
    }

    /**
    * Payments
    *  get payment information for the current user(seller)
    *
    * @param  User
    * @return array
    */
    public static function payments($user=null)
    {
        return OauthHelper::get(static::user_url($user) . 'payments/templates', array(), $user);
    }
    
    /**
     *  Users
     *
     *  get user info including creation tsz for the current user
     *  also returns feedback % score
     *
     * @param  User
     * @return array
     */
    public static function user($user=null)
    {
        return OauthHelper::get(static::user_url($user), array('includes'=>'Profile'), $user);
    }

    /**
     * Avatar
     * 
     * Get the user avatar URL
     *
     * @param  User
     * @return array
     */
    public static function avatar($user=null)
    {
        return OauthHelper::get(static::user_url($user) . 'profile', array(), $user);
    }

    /**
     * Billing
     *  get billing info for the current user
     *
     * @param  User
     * @return array
     */
    public static function billing($user=null)
    {
        return OauthHelper::get(static::user_url($user) . 'billing/overview', array(), $user);
    }

    /**
    * Cart
    * get info on current user's cart
    *
    * @param  User
    * @return array
    */
    public static function cart($user=null)
    {
        return OauthHelper::get(static::user_url($user) . 'carts', array(), $user);
    }

    /**
     * Favorited
     *  show who and how many people are favoriting the current user
     *
     * @param  User
     * @return array
     */
    public static function favorited($user=null)
    {
        return OauthHelper::get(static::user_url($user) . 'favored-by', array(), $user);
    }
    /**
     * Receipt
     *  get receipt information for the current user
     *
     * @param  User
     * @return array
     */
    public static function receipt($user=null)
    {
        return OauthHelper::get(static::user_url($user) . 'receipts', array(), $user);
    }

    /**
     * Shipping
     *  get current shipping information for the current user
     *
     * @param  User
     * @return array
     */
    public static function shipping($user=null)
    {
        return OauthHelper::get(static::user_url($user) . 'shipping/templates', array(), $user);
    }

    /**
     * Shops
     *  get shops for the current user
     *
     * @param  User
     * @return array
     */
    public static function shops($user=null)
    {
        return OauthHelper::get(static::user_url($user) . 'shops', array(), $user);
    }

    /**
     * Teams
     *  get teams current user is a part of
     *
     * @param  User
     * @return array
     */
    public static function teams($user=null)
    {
        return OauthHelper::get(static::user_url($user) . 'teams', array(), $user);
    }

    /**
     * Transactions
     *  get transactions between current user and shop 
     *
     * @param  User
     * @return array
     */
    public static function transactions($user=null)
    {
        return OauthHelper::get(static::user_url($user) . 'transactions', array(), $user);
    }

    /**
     * Treasury
     *  get treasury of current user 
     *
     * @param  User
     * @return array
     */
    public static function treasury($user=null)
    {
        return OauthHelper::get(static::user_url($user) + 'treasuries', array(), $user);
    }

    /**
     * User URL
     *
     * Get base user url
     *
     * @param  User
     * @return string
     */
    protected static function user_url($user=null)
    {
        return '/users/' . ((is_null($user)) ? '__SELF__' : $user->user_id) . '/';
    }

    /**
     * Flatten
     *
     * method to flatten oauth responses
     *
     * @param  $response stdObject
     * @return array
     */
    protected static function flatten($response)
    {
        return $response->results;
    }

}