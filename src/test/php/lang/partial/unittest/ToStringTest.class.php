<?php namespace lang\partial\unittest;

class ToStringTest extends PartialTest {

  #[@test]
  public function without_members() {
    $this->fixture= $this->declareType([], '{
      use <T>\with\lang\partial\ToString;
    }');
    $instance= $this->fixture->newInstance();
    $this->assertEquals(
      $this->fixture->getName().'@(#'.$instance->hashCode().')',
      $instance->toString()
    );
  }

  #[@test]
  public function with_one_member() {
    $this->fixture= $this->declareType([], '{
      use <T>\with\lang\partial\ToString;

      private $name;
      public function __construct($name) {
        $this->name= $name;
      }
    }');
    $this->assertEquals(
      $this->fixture->getName().'@("Test")',
      $this->fixture->newInstance('Test')->toString()
    );
  }

  #[@test]
  public function with_multiple_members() {
    $this->fixture= $this->declareType([], '{
      use <T>\with\lang\partial\ToString;

      private $id, $name, $skills;
      public function __construct($id, $name, $skills= []) {
        $this->id= $id;
        $this->name= $name;
        $this->skills= $skills;
      }
    }');
    $this->assertEquals(
      $this->fixture->getName()."@[\n  id => 6100\n  name => \"Test\"\n  skills => [\"Dev\"]\n]",
      $this->fixture->newInstance(6100, 'Test', ['Dev'])->toString()
    );
  }}