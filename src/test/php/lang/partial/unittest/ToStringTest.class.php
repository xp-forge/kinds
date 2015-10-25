<?php namespace lang\partial\unittest;

class ToStringTest extends PartialTest {

  #[@test]
  public function without_members() {
    $fixture= $this->declareType([], '{
      use <T>\with\lang\partial\ToString;
    }');
    $instance= $fixture->newInstance();
    $this->assertEquals(
      $fixture->getName().'@(#'.$instance->hashCode().')',
      $instance->toString()
    );
  }

  #[@test]
  public function with_one_member() {
    $fixture= $this->declareType([], '{
      use <T>\with\lang\partial\ToString;

      private $name;
      public function __construct($name) {
        $this->name= $name;
      }
    }');
    $this->assertEquals(
      $fixture->getName().'@("Test")',
      $fixture->newInstance('Test')->toString()
    );
  }

  #[@test]
  public function with_multiple_members() {
    $fixture= $this->declareType([], '{
      use <T>\with\lang\partial\ToString;

      private $id, $name, $skills;
      public function __construct($id, $name, $skills= []) {
        $this->id= $id;
        $this->name= $name;
        $this->skills= $skills;
      }
    }');
    $this->assertEquals(
      $fixture->getName()."@[\n  id => 6100\n  name => \"Test\"\n  skills => [\"Dev\"]\n]",
      $fixture->newInstance(6100, 'Test', ['Dev'])->toString()
    );
  }}