<?php

class Etsy_Controller extends Base_Controller {

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
    public function get_index()
    {
        echo '<pre>';
        print_r(Etsy::user());
    }

}