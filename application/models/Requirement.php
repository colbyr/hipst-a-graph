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

    public static function make_or_retrieve($noun, $verb, $value)
    {
        $r = Requirement::where('value', '=' ,$value)
            ->where('verb', '=' ,$verb)
            ->where('noun', '=' ,$noun)->first();
        if ($r === null)
        {
            echo "sex\n";
            $r = new Requirement();
            $r->value = $value;
            $r->verb = $verb;
            $r->noun = $noun;
            $r->save();
        } 
        return $r;
    }

    /**
     * [One to Many] requirements
     * 
     * @return array
     */
    public function achievements()
    {
        return $this->has_many_and_belongs_to('Achievement');
    }

}
