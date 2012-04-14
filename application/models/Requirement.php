<?php
class Requirement extends Aware
{
    public static $accessible = array('noun', 'verb', 'value');

    public function achievement()
    {
        $this -> has_many_and_belongs_to('Achievements');
    }

    /**
    *
    * Aware validation
    *
    */
    public static $rules = array (
        'noun' => 'required'
        'verb' => 'required');

}
