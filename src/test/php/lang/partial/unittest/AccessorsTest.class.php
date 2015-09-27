<?php namespace lang\partial\unittest;

class AccessorsTest extends PartialTest {

  #[@test, @values(['private', 'protected', 'public'])]
  public function generates_accessor_method_for_instance_field($modifier) {
    $fixture= $this->declareType([], sprintf('{
      use <T>\with\lang\partial\Accessors;

      %s $name;
    }', $modifier));
    $this->assertDeclaresMethods(['public var name()'], $fixture);
  }

  #[@test]
  public function does_not_generate_accessors_for_static_fields() {
    $fixture= $this->declareType([], '{
      use <T>\with\lang\partial\Accessors;

      static $name;
    }');
    $this->assertDeclaresMethods([], $fixture);
  }

  #[@test]
  public function generates_accessor_methods_in_order_fields_are_declared() {
    $fixture= $this->declareType([], '{
      use <T>\with\lang\partial\Accessors;

      private $name, $handle;
      private $id= -1;
    }');
    $this->assertDeclaresMethods(['public var name()', 'public var handle()', 'public var id()'], $fixture);
  }
}