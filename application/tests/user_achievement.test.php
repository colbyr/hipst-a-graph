<?php

class TestUserAchivements extends PHPUnit_Framework_TestCase {

   protected $u;
   protected $a;

    protected function setUp()
    {
        $this->u = static::makeUser();
        $this->a = static::makeAchievement();
    }

   protected function tearDown()
   {
      if($this->u != null)
        $this->u->delete();
        if($this->a != null)
        $this->a->delete();
   }

   public function testAddAchievement()
   {
      $this->u->save();
      $this->a->save();
      $this->u->achievements()->insert($this->a);
      print_r($this->u->achievements()->get());
      $this->assertEquals(1, count($this->u->achievements()->get()));
   }


    public static function makeUser()
    {
        $u = new User();
        $u->username = 'test9';
        $u->password = 'derp';
        return $u;
    }

    public static function makeAchievement()
    {
        $a = new Achievement();
        $a->name = 'teeeeeeeeeeeeeeest';
        $a->value = 20.01;
        $a->description = 'effing awesome2';
        return $a;
    }

}
