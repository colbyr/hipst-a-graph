<?php

class addacheievements_task
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
        $file_string = file_get_contents(getcwd()."/application/tasks/achievements.json");
        $json = json_decode($file_string);
        foreach ($json as $key => $value) 
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
                 $r = Requirement::make_or_retrieve(
                        $requirement->query,
                        $requirement->noun,
                        $requirement->verb,
                        $requirement->value
                        );
                 $a->requirements()->attach($r->id);

            }

        }
    }

}