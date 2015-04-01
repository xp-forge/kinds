<?php namespace lang\kind\unittest;

class IdentityTest extends \unittest\TestCase {

  #[@test]
  public function name() {
    $this->assertEquals('Test', (new Named('Test'))->name());
  }

  #[@test]
  public function value() {
    $this->assertEquals('Test', (new Named('Test'))->value());
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
  public function is_not_equal_to_another_instance_with_different_name() {
    $this->assertNotEquals(new Named('A'), new Named('B'));
  }

  #[@test]
  public function string_of() {
    $this->assertEquals('lang.kind.unittest.Named("A")', (new Named('A'))->toString());
  }
}