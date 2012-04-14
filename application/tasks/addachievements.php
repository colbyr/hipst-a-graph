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
            if(!$a->save())
            {
                echo "achievement with name:".$a->name."did not save";
            }
            foreach($value->requirements as $requirement)
            {
                $r = new Requirement();
                $requirement->noun;
                $requirement->verb;
                $requirement->value;
                $r->achievement_id = $a->id;
                if(!$r->save())
                {
                    echo "requirement:".$r->noun."did not save";

                }
            }

        }
    }

    // private function new_requirement($rvalue)
    // {

    // }

}