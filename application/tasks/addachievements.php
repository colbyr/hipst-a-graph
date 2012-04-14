<?php

class addachievements_task
{
    /**
    *
    * A task that populates the achievements by reading from a json file.
    * Expects requirements to be embedded inside of the achievement that 
    * requires them. After completion the database should be full of achievements
    * and requirements.  
    *
    */
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
                    echo "requirement:".$r->noun."did not save with a_id:".$r->achievement_id;

                }
            }

        }
    }

}