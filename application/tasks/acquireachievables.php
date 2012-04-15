<?php
public class AquireAchievables
{
    $flat_json;

    public function getEtsyFunction($query)
    {
        return Etsy::$query();
    }

    public function run($arguments)
    {
        //get an array of all of the achievement already earned
        $achievements = getAchievements($arguments[0]);
        
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
                $arguments[0]->achievements()->attach($unearned->id);

            $oldquery = $query;
       }
    }

    public function check($json, $unearned){
      $noun = $unearned->noun;
      $verb = $unearned->verb;
      $value = $unearned->value;

      $results = array_keys($flat_json, $unearned->noun);

      foreach($results as $r){
        $value = $flat_jon[$r];
        switch($unearned->verb)
        {
          case '=':
            if($value === $unearned->value)
            { 
              return true;
            }
            break;
          case '!=':
            if($value != $unearned->value)
            {
              return true;
            }
            break;
          case '=>':
            if($value >= $unearned->value)
            {
              return true;
            }
            break;
          default:
            echo "invalid verb";
        }
        if( $unearned->verb $unearned->value);
          return true;
      }

      //TODO: Search JSON for the noun of $unearned
      //Compare values between $unearned and $json (with $verb)
      //return a boolean (is above comparison true or false)
    }

    public function flatten(){
      $a = array();
      $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($a));
      foreach($it as $v) {
        array_push($a, $v);
      }

    }

    public function array_max_depth($array, $depth = 0) {
      $max_sub_depth = 0;
      foreach (array_filter($array, 'is_array') as $subarray) {
        $max_sub_depth = max(
        $max_sub_depth,
        array_max_depth($subarray, $depth + 1)
      );
    }
    return $max_sub_depth + $depth;
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
