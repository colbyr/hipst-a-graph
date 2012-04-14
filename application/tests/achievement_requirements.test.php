<?php

class TestAchievement_Requiements extends PHPUnit_Framework_TestCase {

   protected $a;
   protected $r;

    protected function setUp()
    {
        echo "set up";
        $this->a = static::makeAchievement();
        $this->r = static::makeRequirement();
    }

    protected function tearDown()
    {
        if($this->a != null)
        $this->a->delete();
        if($this->r != null)
        $this->r->delete();   
    }

    public function testSaveAchievment()
    {
        echo "test saving Achievements";
        $this->assertTrue($this->a->save());
    }

    public function testSaveRequirement()
    {
        echo "test saving requirements";
        $this->assertTrue($this->r->save());
    }

    public static function makeAchievement()
    {
        $a = new Achievement();
        $a->name = 'test5';
        $a->value = 20.00;
        $a->description = 'effing awesome';
        return $a;
    }

    public static function makeRequirement()
    {
        $r = new Requirement();
        $r->noun = 'test1';
        $r->value = 20.00;
        $r->verb = 'different';
        return $r;
    }

}
