<?php

class TestAchievement extends PHPUnit_Framework_TestCase {

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

  public function testSomethingIsTrue()
  {
    $this->assertTrue(true);
  }

  public function testAchievementConstructor()
  {
    $a = static::makeAchievement();
    $this->assertNotNull($a);
  }

  public function testRequirementConstructor()
  {
    $a = static::makeRequirement();
    $this->assertNotNull($a);
  }

  public function testSaveAchievement(){
    echo "test saving achievements";
    $this->assertTrue($this->a->save());
  }

  public function testSaveRequirement(){
    echo "test saving requirements";
    $this->r->achievement_id = $this->a->id;
    $this->assertTrue($this->r->save());
  }

  // public function testAchievementRelationship()
  // {
    // $a = static::makeAchievement();
    // $r = static::makeRequirement($a->id, 'test', 'test', '5');
    // $this->assertEquals($r->achievement_id, $a->id);
  // }

  public static function makeAchievement()
  {
      $a = new Achievement();
      $a->name = 'tester';
      $a->value = 20.00;
      $a->description = 'effing awesome';
      return $a;
  }

  public static function makeRequirement()
  {
    $r = new Requirement();
    // $r->$achievement_id = $a_id;
    // $r->$noun = $noun;
    // $r->$verb = $verb;
    // $r->$value = $value;
    return $r;
  }

}
