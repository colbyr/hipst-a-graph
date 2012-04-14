<?php
class User extends Aware
{
    
    public static $accessable = array('email');

    public function achievements()
    {
        $this -> has_many_and_belongs_to('Achievements');
    }


}