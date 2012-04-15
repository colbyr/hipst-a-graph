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
    public static function favorites($etsy_id=0)
    {
        $params = array(
                'fields'=>'listing_id',
                'includes'=>'Listing'
            );

        $response = OauthHelper::get(static::user_url($etsy_id) . 'favorites/listings', $params);

        return static::flatten($response);
    }

    /**
     * Orders
     *  get orders associated with the current user
     *
     * @return array
     */
    public static function orders($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id) . 'orders');
    }

    /**
    * Payments
    *  get payment information for the current user(seller)
    *
    * @return array
    */
    public static function payments($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id) . 'payments/templates');
    }
    
    /**
     *  Users
     *
     *  get user info including creation tsz for the current user
     *  also returns feedback % score
     *
     * @return array
     */
    public static function user($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id), array('includes'=>'Profile'));
    }

    /**
     * Avatar
     * 
     * Get the user avatar URL
     *
     * @return array
     */
    public static function avatar($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id) . 'profile');
    }

    /**
     * Billing
     *  get billing info for the current user
     *
     * @return array
     */
    public static function billing($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id) . 'billing/overview');
    }

    /**
    * Cart
    * get info on current user's cart
    *
    *@return array
    */
    public static function cart($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id) . 'carts');
    }

    /**
     * Favorited
     *  show who and how many people are favoriting the current user
     *
     * @return array
     */
    public static function favorited($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id) . 'favored-by');
    }
    /**
     * Receipt
     *  get receipt information for the current user
     *
     * @return array
     */
    public static function receipt($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id) . 'receipts');
    }

    /**
     * Shipping
     *  get current shipping information for the current user
     *
     * @return array
     */
    public static function shipping($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id) . 'shipping/templates');
    }

    /**
     * Shops
     *  get shops for the current user
     *
     * @return array
     */
    public static function shops($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id) . 'shops');
    }

    /**
     * Teams
     *  get teams current user is a part of
     *
     * @return array
     */
    public static function teams($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id) . 'teams');
    }

    /**
     * Transactions
     *  get transactions between current user and shop 
     *
     * @return array
     */
    public static function transactions($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id) . 'transactions');
    }

    /**
     * Treasury
     *  get treasury of current user 
     *
     * @return array
     */
    public static function treasury($etsy_id=0)
    {
        return OauthHelper::get(static::user_url($etsy_id) + 'treasuries');
    }

    /**
     * User URL
     *
     * Get base user url
     *
     * @param  integer
     * @return string
     */
    protected static function user_url($etsy_id=0)
    {
        return '/users/' . (($etsy_id === 0) ? '__SELF__' : $etsy_id) . '/';
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