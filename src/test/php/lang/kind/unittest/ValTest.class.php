<?php namespace lang\kind\unittest;

class ValTest extends \unittest\TestCase {

  #[@test]
  public function name() {
    $this->assertEquals('Test', (new Named('Test'))->name());
  }

  #[@test]
  public function is_equal_to_itself() {
    $fixture= new Named('Test');
    $this->assertEquals($fixture, $fixture);
  }

  #[@test]
  public function is_equal_to_another_instance_with_same_name() {
    $this->assertEquals(new Named('A'), new Named('A'));
  }

  #[@test]
  public function is_equal_to_another_instance_with_different_name() {
    $this->assertNotEquals(new Named('A'), new Named('B'));
  }
}