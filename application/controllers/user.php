<?php
use Laravel\CLI\Command;
require path('sys').'cli/dependencies'.EXT;
class User_Controller extends Base_Controller {

    /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [GET] Index
     *
     * @return View
     */
    public function get_profile($id=0)
    {

        $user = ($id === 0) ? Auth::user() : User::find($id);

        if ($id === 0)
        {
            if (Auth::user()->oauth_token === '') return Redirect::to('oauth');
        }

        if (is_null($user) || (!Auth::check() && $id === 0))
        {
            return Response::error(404);
        }

        // Command::run(array('acquireachievables',"$user->id"));

        return View::make('user.profile')
                    ->with('user', $user)
                    ->with('favorites', Etsy::favorites($user));
    }

}