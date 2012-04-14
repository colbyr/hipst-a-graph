<?php
class Achievement extends Aware
{
    /**
     * Accessible
     *  for mass-assignment...
     */
    public static $accessible = array('name', 'value', 'description');

    /**
     * [Many to Many] Users
     * 
     * @return array
     */
    public function users()
    {
        return $this->has_many_and_belongs_to('User');
    }

    /**
     * [Many to Many] requirements
     * 
     * @return array
     */
    public function requirements()
    {
        return $this->has_many('Requirement');
    }

    // /**
    // *
    // * Aware validation rules
    // *
    // */
    // public static $rules = array (
    //         'name' => 'required',
    //         'value' => 'required'
    //     );

}
