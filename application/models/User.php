<?php


class User extends Aware
{
    
    /**
     * Accessible
     *  for mass-assignment...
     */
    public static $accessable = array('email');

    /**
     * [Many to Many] Achievements
     *
     * @return array
     */
    public function achievements()
    {
        $this -> has_many_and_belongs_to('Achievements');
    }


}