<?php
class addrequirements_task
{

        public function run($arguments)
        {
            $file_string = file_get_contents(getcwd()."/application/tasks/requirements.json");
            $jason = json_decode($file_string);
            foreach ($jason as $key => $value) {
                $r = new Reqirement();
                $r->noun = $value->noun;
                $r->verb = $value->verb; 
                $r->value = $value->value;  
                if(!$r->save())
                {
                    echo "you don fucked up";
                }
            }
    }

}