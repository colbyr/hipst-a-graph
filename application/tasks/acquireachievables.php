<?php
class AcquireAchievables
{

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
        $flat_json;

        foreach($unearned_achievements as $unearned)
        {
            //get query
            $query = $unearned->query;

            if($query != $oldquery)
            {
                $json = getEtsyFunction($query);
            }

            if(check($json, $unearned))
            {  
                $arguments[0]->achievements()->attach($unearned->id);
            }

            $oldquery = $query;
       }
    }

    public function check($json, $unearned){
      //flatten the json into a single dimmensional map
      $results = array_keys($json, $unearned->noun);

      $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($json));
      foreach($it as $key => $value)
      {
        if($key === $unearned->noun)
        {
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
        }
      }
      return false;
    }

    public function flatten(){
      $a = array();
      $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($a));
      foreach($it as $v) {
        array_push($a, $v);
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
