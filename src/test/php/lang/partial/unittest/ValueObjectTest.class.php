<?php namespace lang\partial\unittest;

use unittest\Test;
use util\Date;

class ValueObjectTest extends \unittest\TestCase {

  #[Test]
  public function name() {
    $this->assertEquals('Test', (new Wall('Test', 'closed', []))->name());
  }

  #[Test]
  public function type() {
    $this->assertEquals('open', (new Wall('Test', 'open', []))->type());
  }

  #[Test]
  public function posts() {
    $this->assertEquals([], (new Wall('Test', 'open', []))->posts());
  }

  #[Test]
  public function is_equal_to_itself() {
    $fixture= new Wall('Test', 'open', []);
    $this->assertEquals($fixture, $fixture);
  }

  #[Test]
  public function is_equal_to_another_instance_with_same_name() {
    $this->assertEquals(new Wall('A', 'open', []), new Wall('A', 'open', []));
  }

  #[Test]
  public function is_not_equal_to_another_instance_with_different_type() {
    $this->assertNotEquals(new Wall('A', 'open', []), new Wall('A', 'closed', []));
  }

  #[Test]
  public function is_not_equal_to_another_instance_with_different_name() {
    $this->assertNotEquals(new Wall('A', 'open', []), new Wall('B', 'open', []));
  }

  #[Test]
  public function string_of() {
    $date= Date::now();
    $this->assertEquals(
      "lang.partial.unittest.Comment@[\n  author => \"Tester\"\n  text => \"Test\"\n  date => ".$date->toString()."\n]",
      (new Comment('Tester', 'Test', $date))->toString()
    );
  }

  #[Test]
  public function declared_accessor_not_overwritten() {
    $this->assertEquals('Comment: Test', (new Comment('Tester', 'Test', Date::now()))->text());
  }
}