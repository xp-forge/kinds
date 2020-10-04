<?php namespace lang\partial\unittest;

use unittest\{Test, TestCase};

class ConstructorTest extends TestCase {

  #[Test]
  public function firstName() {
    $this->assertEquals('Timm', (new Person('Timm', 'Test', 1977))->firstName());
  }

  #[Test]
  public function lastName() {
    $this->assertEquals('Test', (new Person('Timm', 'Test', 1977))->lastName());
  }

  #[Test]
  public function born() {
    $this->assertEquals(1977, (new Person('Timm', 'Test', 1977))->born());
  }
}