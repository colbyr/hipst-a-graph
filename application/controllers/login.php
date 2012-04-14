<?php

class Login_Controller extends Base_Controller {

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */

    public function __construct()
    {
        $this->filter('before', 'authed')->except('leave');

        parent::__construct();
    }

    /**
     * [GET] Index
     *
     * @return View
     */
    public function get_index()
    {
        return View::make('home.login');
    }

    public function post_index()
    {
        if (Auth::attempt(Input::get('username'), Input::get('password')))
        {
            $user = Auth::user();
            if ($user->oauth_token === '') {
                return Redirect::to('oauth');
            }
            else
            {
                return Redirect::to('user/profile');
            }
        }
        else
        {
            return View::make('home.login')->with('error', 'wrong user/pass');
        }
    }

    public function get_new()
    {
        return View::make('home.register');
    }

    public function post_new()
    {
        $user = new User();
        $user->username = Input::get('username');
        $user->password = Input::get('password');
        
        if ($user->save()) {
            Auth::login($user);
            return Redirect::to('user/profile');
        }
        else
        {
            return View::make('home.register')->with('error', 'something went wrong');
        }
    }

    public function get_leave()
    {
        Auth::logout();
        return Redirect::to('login');
    }

}