<?php namespace lang\partial\unittest;

class ConstructorTest extends \unittest\TestCase {

  #[@test]
  public function firstName() {
    $this->assertEquals('Timm', (new Person('Timm', 'Test', 1977))->firstName());
  }

  #[@test]
  public function lastName() {
    $this->assertEquals('Test', (new Person('Timm', 'Test', 1977))->lastName());
  }

  #[@test]
  public function born() {
    $this->assertEquals(1977, (new Person('Timm', 'Test', 1977))->born());
  }
}