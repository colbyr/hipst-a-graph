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
    public static function favorites()
    {
        $params = array(
                'fields'=>'listing_id',
                'includes'=>'Listing'
            );

        $response = OauthHelper::get('/users/__SELF__/favorites/listings', $params);

        return static::flatten($response);
    }

    /**
     * Orders
     *  get orders associated with the current user
     *
     * @return array
     */
    public static function orders()
    {
        return OauthHelper::get('users/__SELF__/orders');
    }

    /**
    * Payments
    *  get payment information for the current user(seller)
    *
    * @return array
    */
    public static function payments()
    {
        return OauthHelper::get('/users/__SELF__/payments/templates');
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
        return OauthHelper::get('/users/__SELF__', array('includes'=>'Profile'));
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
        return OauthHelper::get('/users/__SELF__/profile');
    }

    /**
     * Billing
     *  get billing info for the current user
     *
     * @return array
     */
    public static function billing()
    {
        return OauthHelper::get('/users/__SELF__/billing/overview');
    }

    /**
    * Cart
    * get info on current user's cart
    *
    *@return array
    */
    public static function cart()
    {
        return OauthHelper::get('/users/__SELF__/carts');
    }

    /**
     * Favorited
     *  show who and how many people are favoriting the current user
     *
     * @return array
     */
    public static function favorited()
    {
        return OauthHelper::get('/users/__SELF__/favored-by');
    }
    /**
     * Receipt
     *  get receipt information for the current user
     *
     * @return array
     */
    public static function receipt()
    {
        return OauthHelper::get('/users/__SELF__/receipts');
    }

    /**
     * Shipping
     *  get current shipping information for the current user
     *
     * @return array
     */
    public static function shipping()
    {
        return OauthHelper::get('/users/__SELF__/shipping/templates');
    }

    /**
     * Shops
     *  get shops for the current user
     *
     * @return array
     */
    public static function shops()
    {
        return OauthHelper::get('/users/__SELF__/shops');
    }

    /**
     * Teams
     *  get teams current user is a part of
     *
     * @return array
     */
    public static function teams()
    {
        return OauthHelper::get('/users/__SELF__/teams');
    }

    /**
     * Transactions
     *  get transactions between current user and shop 
     *
     * @return array
     */
    public static function transactions()
    {
        return OauthHelper::get('/users/__SELF__/transactions');
    }

    /**
     * Treasury
     *  get treasury of current user 
     *
     * @return array
     */
    public static function treasury()
    {
        return OauthHelper::get('/users/__SELF__/treasuries');
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