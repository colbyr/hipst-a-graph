<?php
public class AquireAchievables
{

    public function getEtsyFunction($query)
    {
        return Etsy::$query();
    }

    public function aquire($user)
    {
        //get an array of all of the achievement already earned
        $achivements = getAchievements($user);
        
        //get the achivements not earned yet
        //mutlidementional [query][object]
        $open_achivements = unearned($achivements);

        //here is where we should do it in a background process
        //but for now lets do this:
        //loop through the array of unearned achivements
        foreach($open_achivements as $query)
        {   
            //make the query
            $json = getEtsyFunction($query);
            //loop through the values
            foreach ($query as $achievement) 
            {
                //check the achivement
                if(check($achievement))
                    $user->achivements()->attach($achivement->id);
            }
        }
    }
}
