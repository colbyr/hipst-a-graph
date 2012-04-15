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
    public function get_profile($id=0)
    {

        $user = ($id === 0) ? Auth::user() : User::find($id);

        if (is_null($user))
        {
            return Response::error(404);
        }

        Command::run(array('acquireachievables',"$user->id"));

        return View::make('user.profile')
                    ->with('user', Auth::user())
                    ->with('favorites', Etsy::favorites());
    }

}