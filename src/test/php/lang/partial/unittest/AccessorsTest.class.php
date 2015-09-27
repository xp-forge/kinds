<?php namespace lang\partial\unittest;

class AccessorsTest extends PartialTest {

  #[@test]
  public function generates_accessor_method_for_private_field() {
    $fixture= $this->declareType('{
      private $name;

      use <T>\with\lang\partial\Accessors;
    }');
    $this->assertDeclaresMethods(['public var name()'], $fixture);
  }

  #[@test]
  public function generates_accessor_methods_in_order_fields_are_declared() {
    $fixture= $this->declareType('{
      private $name, $handle;
      private $id= -1;

      use <T>\with\lang\partial\Accessors;
    }');
    $this->assertDeclaresMethods(['public var name()', 'public var handle()', 'public var id()'], $fixture);
  }
}