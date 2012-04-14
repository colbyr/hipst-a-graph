<?php
class Achievement extends Aware
{
    public static $accessible = array('name', 'value');

    public function users()
    {
        $this -> has_many_and_belongs_to('Users');
    }

    public function achievements()
    {
        $this -> has_many_and_belongs_to('Requirements');
    }

    /**
    *
    * Aware validation
    *
    */
    public static $rules = array (
        'name' => 'required'
        'value' => 'required');

}
