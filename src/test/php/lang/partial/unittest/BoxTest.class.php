<?php namespace lang\partial\unittest;

use unittest\{Test, TestCase};

class BoxTest extends TestCase {

  #[Test]
  public function name() {
    $this->assertEquals('Test', (new Named('Test'))->name());
  }

  #[Test]
  public function value() {
    $this->assertEquals('Test', (new Named('Test'))->value());
  }

  #[Test]
  public function isEmpty_for_non_empty_string() {
    $this->assertFalse((new Named('Test'))->isEmpty());
  }

  #[Test]
  public function isEmpty_for_empty_string() {
    $this->assertTrue((new Named(''))->isEmpty());
  }

  #[Test]
  public function is_equal_to_itself() {
    $fixture= new Named('Test');
    $this->assertEquals($fixture, $fixture);
  }

  #[Test]
  public function is_equal_to_another_instance_with_same_name() {
    $this->assertEquals(new Named('A'), new Named('A'));
  }

  #[Test]
  public function is_not_equal_to_another_instance_with_different_name() {
    $this->assertNotEquals(new Named('A'), new Named('B'));
  }

  #[Test]
  public function string_of() {
    $this->assertEquals('lang.partial.unittest.Named("A")', (new Named('A'))->toString());
  }

  #[Test]
  public function value_can_be_accessed() {
    $named= new class('A') extends Named {
      public function rename($value) { $this->value= $value; }
    };
    $named->rename('B');
    $this->assertEquals('B', $named->value());
  }
}