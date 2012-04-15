<?php
class AquireAchievables
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

        //make variables that persist during the foreach 
        $json;
        $query;
        $oldquery;

        foreach($unearned_achievements as $unearned)
        {
            //get query
            $query = $unearned->query;

            if($query != $oldquery){
                $json = getEtsyFunction($query);
                $flat_json = flatten($json);
            }

            if(check($flat_json, $unearned))
                $arguments[0]->achievements()->attach($unearned->id);

            $oldquery = $query;
       }
    }

    public function check($flat_json, $unearned){
      //flatten the json into a single dimmensional map
      $results = array_keys($flat_json, $unearned->noun);

      //look through each result
      foreach($results as $r){
        $value = $flat_json[$r];
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
    }

    public function flatten($json){
      $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($json));
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
        //add the id's of earned achievements into the array
        foreach ($achievements as $achievement) 
        {
            array_push($array, $achievement->id);
        }
        //find the unearned achievements and return sorted
        return $unearned = DB::table('achievements')
                ->where_not_in('id', $array)
                ->order_by('query', 'desc')
                ->get();
    }
}
