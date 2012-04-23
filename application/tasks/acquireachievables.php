<?php
class Acquireachievables_Task
{

    public function getEtsyFunction($query , $user)
    {
        return Etsy::$query($user);
    }

    public function run($arguments)
    {
        $user = User::find($arguments[0]);
        //print_r($user);exit();
        //get an array of all of the achievement already earned
        if($user != null)
        {
          $achievements = $this->getAchievements($user);
          
          //get the achievements not earned yet
          //array of unearned achievements
          $unearned_achievements = $this->unearned($achievements);

          //here is where we should do it in a background process
          //but for now lets do this:
          //loop through the array of unearned achievements
          
          $query;
          $json;
          $user_json = '';
          $receipt_json = '';
          $shops_json = '';
          $favorites_json = '';

          

          foreach($unearned_achievements as $unearned)
          {
              $requirement = $unearned->requirements()->first();
              //get query
              if(is_object($requirement))
               {
                $query = $requirement->query;

                if($query == 'user' && $user_json == null)
                {
                    $user_json = $this->getEtsyFunction($query , $user);
                    $json = $user_json;
                }

                else if($query == 'receipt' && $receipt_json == null)
                {
                    $receipt_json = $this->getEtsyFunction($query , $user);
                    $json = $receipt_json;
                }

                else if($query == 'shops' && $shops_json == null)
                {
                    $shops_json = $this->getEtsyFunction($query , $user);
                    $json = $shops_json;
                }

                else if($query == 'favorites' && $favorites_json == null)
                {
                    $favorites_json = $this->getEtsyFunction($query , $user);
                    $json = $favorites_json;
                }

                if($this->check($json, $requirement))
                {  
                    $user->achievements()->attach($unearned->id);
                    $user->score += $unearned->value;
                }
                $oldquery = $query;
            }
        }
        $user->save();
      } else {
        runNightly();
      }
    }

    public function check($json, $unearned){

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
            case '=<':
              if($value <= $unearned->value)
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

    public function getUsers(){
        return $user->get();
    }

    public function unearned($achievements)
    {
        $array = array();
        foreach ($achievements as $achievement) 
        {
            array_push($array, $achievement->id);
        }
        if(count($array) > 0){
          return Achievement::with('requirements')
                ->where_not_in('id', $array)
                ->get();
        }
        else {
          return Achievement::with('requirements')->all();
        }
    }

    public function runNightly(){
        $users = getUsers();

        foreach($users as $user)
        {
            run($user->id);
        }
    }
}
