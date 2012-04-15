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
        $achievements = getAchievements($user);
        
        //get the achievements not earned yet
        //array of unearned achievements
        $unearned_achievements = unearned($achievements);

        //here is where we should do it in a background process
        //but for now lets do this:
        //loop through the array of unearned achievements
        
        $json;
        $query;
        $oldquery;

        foreach($unearned_achievements as $unearned)
        {   
            //get query
            $query = $unearned->query;

            if($query != $oldquery){
                $json = getEtsyFunction($query);
            }

            if(check($json, $unearned))
                $user->achievements()->attach($unearned->id);

            $oldquery = $query;
       }
    }

    public function getAchievements($user)
    {
        return $user->achievements()->get();
    }

    public function unearned($achievements)
    {
        $array;
        foreach ($achievements as $achievement) 
        {
            array_push($array, $achievement->id);
        }
        return $unearned = DB::table('achievements')
                ->where_not_in('id', $array)
                ->order_by('query', 'desc')
                ->get();
    }

    // public function buildArray($unearned)
    // {
    //     foreach ($unearned as $achievement) 
    //     {
            
    //     }
    // }

}
