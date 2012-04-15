<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Oauth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Keystring
     *
     * The application's api key
     *
     * @var string
     */
    'keystring' => 'eyy20g4fis76a8mypze6qqbo',

    /**
     * Secret
     *
     * The application's secret key
     *
     * @var string
     */
    'secret' => 'pb8e4h4awi',

    /**
     * URL
     *
     * The oauth service's URL
     *
     * @var string
     */
    'url' => 'http://openapi.etsy.com/v2/',

    /**
     * Callback URL
     *
     * The application callback for handling a successful auth
     *
     * @var string
     */
    'callback' => 'http://localhost/hipst-a-graph/public/oauth/callback'

);