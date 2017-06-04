<?php namespace lang\partial\unittest;

use util\Date;

class ValueObjectTest extends \unittest\TestCase {

  #[@test]
  public function name() {
    $this->assertEquals('Test', (new Wall('Test', 'closed', []))->name());
  }

  #[@test]
  public function type() {
    $this->assertEquals('open', (new Wall('Test', 'open', []))->type());
  }

  #[@test]
  public function posts() {
    $this->assertEquals([], (new Wall('Test', 'open', []))->posts());
  }

  #[@test]
  public function is_equal_to_itself() {
    $fixture= new Wall('Test', 'open', []);
    $this->assertEquals($fixture, $fixture);
  }

  #[@test]
  public function is_equal_to_another_instance_with_same_name() {
    $this->assertEquals(new Wall('A', 'open', []), new Wall('A', 'open', []));
  }

  #[@test]
  public function is_not_equal_to_another_instance_with_different_type() {
    $this->assertNotEquals(new Wall('A', 'open', []), new Wall('A', 'closed', []));
  }

  #[@test]
  public function is_not_equal_to_another_instance_with_different_name() {
    $this->assertNotEquals(new Wall('A', 'open', []), new Wall('B', 'open', []));
  }

  #[@test]
  public function string_of() {
    $this->assertEquals(
      "lang.partial.unittest.Wall@[\n  name => \"A\"\n  type => \"open\"\n  posts => []\n]",
      (new Wall('A', 'open', []))->toString()
    );
  }

  #[@test]
  public function declared_accessor_not_overwritten() {
    $this->assertEquals('Comment: Test', (new Comment('Tester', 'Test', Date::now()))->text());
  }
}