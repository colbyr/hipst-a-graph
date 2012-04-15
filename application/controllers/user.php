<?php

class User_Controller extends Base_Controller {

    /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    */

    public function __construct()
    {
        // auth
        $this->filter('before', 'auth');

        // auth
        $this->filter('before', 'oauth');

        parent::__construct();
    }

    /**
     * [GET] Index
     *
     * @return View
     */
    public function get_profile()
    {
        //User::aquire_achievables(Auth::user());
        return View::make('user.profile')
                    ->with('user', Auth::user())
                    ->with('favorites', Etsy::favorites());
    }

}