<?php namespace lang\partial\unittest;

use lang\Value;
use lang\mirrors\TypeMirror;
use unittest\{Test, Values};

class ValueTest extends PartialTest {
  private $fixture;

  /** @return void */
  public function setUp() {
    $this->fixture= $this->declareType([Value::class], '{
      use <T>\is\lang\partial\Value;

      private $id, $name, $skills;
    }');
  }

  #[Test]
  public function declares_constructor() {
    $this->assertTrue((new TypeMirror($this->fixture))->constructor()->present());
  }

  #[Test]
  public function constructor_parameter_order_equals_order_of_member_declaration() {
    $parameters= array_map(
      function($p) { return $p->name(); },
      iterator_to_array((new TypeMirror($this->fixture))->constructor()->parameters())
    );
    $this->assertEquals(['id', 'name', 'skills'], $parameters);
  }

  #[Test, Values(['id', 'name', 'skills'])]
  public function declares_accessors($named) {
    $this->assertTrue((new TypeMirror($this->fixture))->methods()->provides($named));
  }

  #[Test]
  public function declares_toString() {
    $this->assertTrue((new TypeMirror($this->fixture))->methods()->provides('toString'));
  }

  #[Test]
  public function declares_hashCode() {
    $this->assertTrue((new TypeMirror($this->fixture))->methods()->provides('hashCode'));
  }

  #[Test]
  public function declares_compareTo() {
    $this->assertTrue((new TypeMirror($this->fixture))->methods()->provides('compareTo'));
  }
}