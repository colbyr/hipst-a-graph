<?php
class Requirement extends Aware
{

    /**
     *
     * Aware validation 
     *
     */
    public static $rules = array(
            'noun' => 'required',
            'verb' => 'required'
        );

    /**
     * Accessible
     *  for mass-assignment...
     */
    public static $accessible = array('noun', 'verb', 'value');
}
