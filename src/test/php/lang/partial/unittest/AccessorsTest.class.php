<?php namespace lang\partial\unittest;

class AccessorsTest extends PartialTest {

  #[@test, @values(['private', 'protected', 'public'])]
  public function generates_accessor_method_for_instance_field($modifier) {
    $fixture= $this->declareType(sprintf('{
      %s $name;

      use <T>\with\lang\partial\Accessors;
    }', $modifier));
    $this->assertDeclaresMethods(['public var name()'], $fixture);
  }

  #[@test]
  public function does_not_generate_accessors_for_static_fields() {
    $fixture= $this->declareType('{
      static $name;

      use <T>\with\lang\partial\Accessors;
    }');
    $this->assertDeclaresMethods([], $fixture);
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