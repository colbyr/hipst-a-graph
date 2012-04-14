<?php

class TestUserAchivements extends PHPUnit_Framework_TestCase {

   protected $u;
   protected $a;

    protected function setUp()
    {
        $this->u = static::makeAchievement();
        $this->a = static::makeRequirement();
    }




    public static function makeUser()
    {
        $u = new User();
        $u->username = 'test1';
        $u->value = 20.00;
        return $u;
    }

    public static function makeAchievement()
    {
        $a = new Achievement();
        $a->name = 'test5';
        $a->value = 20.00;
        $a->description = 'effing awesome';
        return $a;
    }

}