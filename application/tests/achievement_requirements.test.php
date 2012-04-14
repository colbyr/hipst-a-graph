<?php

class TestAchievement_Requiements extends PHPUnit_Framework_TestCase {

  protected function setUp()
  {
    $a = static::makeAchievement();
    $a->save();
    $r = static::makeRequirement();
    $r->save();
  }

    /**
     * Test that a given condition is met.
     *
     * @return void
     */
    public function testSomethingIsTrue()
    {
        $this->assertTrue(true);
    }

    public function testSaveAchievment()
    {
        $this->assertTrue($a->save());
        $a->delete();
    }

    public function testSaveRequirement()
    {
        $this->assertTrue($r->save());
        $r->delete();
    }

    public static function testSaveRequirement()
    {
        $a->save();
        $r->save();
        $a->insert($r);
        print_r($a->requirements()->get());
        assertEquals(1, count($a->requirements()->get()));
        $r->delete();
        $a->delete();
    }


    public static function makeAchievement()
    {
        $a = new Achievement();
        $a->name = 'test';
        $a->value = 20.00;
        $a->description = 'effing awesome';
        return $a;
    }

    public static function makeRequirement()
    {
        $r = new Requirement();
        $r->noun = 'test';
        $r->value = 20.00;
        $r->verb = 'different';
        return $r;
    }

}
