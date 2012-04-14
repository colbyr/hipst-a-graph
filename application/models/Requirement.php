<?php
class Requirement extends Aware
{
    /**
     * Accessible
     *  for mass-assignment...
     */
    public static $accessible = array('noun', 'verb', 'value');


    /**
     * [Many to Many] Achievements
     * 
     * @return array
     */
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
