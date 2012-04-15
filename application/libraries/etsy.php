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
     * Orders
     *  get orders associated with the current user
     *
     * @return array
     */
    public static function orders()
    {
        return static::get('users/__SELF__/orders');
    }

    /**
    * Payments
    *  get payment information for the current user(seller)
    *
    * @return array
    */
    public static function payments()
    {
        return static::get('/users/__SELF__/payments/templates');
    }
    
    /**
     *  Users
     *
     *  get user info including creation tsz for the current user
     *  also returns feedback % score
     *
     * @return array
     */
    public static function user()
    {
        return static::get('/users/__SELF__', array('includes'=>'Profile'));
    }

    /**
     * Avatar
     * 
     * Get the user avatar URL
     *
     * @return array
     */
    public static function avatar()
    {
        return static::get('/users/__SELF__/profile');
    }

    /**
     * Billing
     *  get billing info for the current user
     *
     * @return array
     */
    public static function billing()
    {
        return static::get('/users/__SELF__/billing/overview');
    }

    /**
    * Cart
    * get info on current user's cart
    *
    *@return array
    */
    public static function cart()
    {
        return static::get('/users/__SELF__/carts');
    }

    /**
     * Favorited
     *  show who and how many people are favoriting the current user
     *
     * @return array
     */
    public static function favorited()
    {
        return static::get('/users/__SELF__/favored-by');
    }
    /**
     * Receipt
     *  get receipt information for the current user
     *
     * @return array
     */
    public static function receipt()
    {
        return static::get('/users/__SELF__/receipts');
    }

    /**
     * Shipping
     *  get current shipping information for the current user
     *
     * @return array
     */
    public static function shipping()
    {
        return static::get('/users/__SELF__/shipping/templates');
    }

    /**
     * Shops
     *  get shops for the current user
     *
     * @return array
     */
    public static function shops()
    {
        return static::get('/users/__SELF__/shops');
    }

    /**
     * Teams
     *  get teams current user is a part of
     *
     * @return array
     */
    public static function teams()
    {
        return static::get('/users/__SELF__/teams');
    }

    /**
     * Transactions
     *  get transactions between current user and shop 
     *
     * @return array
     */
    public static function transactions()
    {
        return static::get('/users/__SELF__/transactions');
    }

    /**
     * Treasury
     *  get treasury of current user 
     *
     * @return array
     */
    public static function treasury()
    {
        return static::get('/users/__SELF__/treasuries');
    }

    /**
     * Get query
     *
     * @param  string $query
     * @return array
     */
    public static function get($query, $params=array())
    {
        $oauth = Auth::user()->oauth();
        try {
            $data = $oauth->fetch("http://openapi.etsy.com/v2/" . $query, $params);
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