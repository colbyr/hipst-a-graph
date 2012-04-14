<?php

class addachievements_task
{

    public function run($arguments)
    {
        echo getcwd();
        $file_string = file_get_contents(getcwd()."/application/tasks/achievements.json");
        print_r($file_string);
        $jason = json_decode($file_string);
        foreach ($jason as $key => $value) 
        {
            $a = new Achievement();
            $a->name = $value->name;
            $a->value = $value->value; 
            $a->description = $value->description;  
            print_r($a);
            // if(!$a->save())
            // {
            //     echo "you don fucked up";
            // }
            foreach($value->requirement as $requirement => $rvalue)
            {
                print_r($rvalue);

            }
        }
    }

    // private function new_requirement($rvalue)
    // {

    // }

}