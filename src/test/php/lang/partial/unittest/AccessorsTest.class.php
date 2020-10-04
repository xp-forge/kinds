<?php namespace lang\partial\unittest;

use unittest\{Ignore, Test, Values};

class AccessorsTest extends PartialTest {

  #[Test, Values(['private', 'protected', 'public'])]
  public function generates_accessor_method_for_instance_field($modifier) {
    $fixture= $this->declareType([], sprintf('{
      use <T>\with\lang\partial\Accessors;

      %s $name;
    }', $modifier));
    $this->assertDeclaresMethods(['public var name()'], $fixture);
  }

  #[Test]
  public function does_not_generate_accessors_for_static_fields() {
    $fixture= $this->declareType([], '{
      use <T>\with\lang\partial\Accessors;

      static $name;
    }');
    $this->assertDeclaresMethods([], $fixture);
  }

  #[Test]
  public function generates_accessor_methods_in_order_fields_are_declared() {
    $fixture= $this->declareType([], '{
      use <T>\with\lang\partial\Accessors;

      private $name, $handle;
      private $id= -1;
    }');
    $this->assertDeclaresMethods(['public var name()', 'public var handle()', 'public var id()'], $fixture);
  }

  #[Test, Ignore, Values([['null', null], ['false', false], ['true', true], ['1', 1], ['0', 0], ['-1', -1], ['"Test"', 'Test'], ['[]', []], ['[1, 2, 3]', [1, 2, 3]],])]
  public function initial_value($literal, $result) {
    $fixture= $this->declareType([], sprintf('{
      use <T>\with\lang\partial\Accessors;

      private $value= %s;
    }', $literal));
    $this->assertEquals($result, $fixture->newInstance()->value());
  }

  #[Test]
  public function keywords() {
    $fixture= $this->declareType([], '{
      use <T>\with\lang\partial\Accessors;

      private $class= "Test";
    }');
    $this->assertEquals('Test', $fixture->newInstance()->class());
  }
}