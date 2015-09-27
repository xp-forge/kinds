<?php namespace lang\partial\unittest;

class AccessorsTest extends PartialTest {

  #[@test, @values(['private', 'protected', 'public'])]
  public function generates_accessor_method_for_field($modifier) {
    $fixture= $this->declareType(sprintf('{
      %s $name;

      use <T>\with\lang\partial\Accessors;
    }', $modifier));
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