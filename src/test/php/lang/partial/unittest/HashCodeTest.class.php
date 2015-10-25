<?php namespace lang\partial\unittest;

class HashCodeTest extends PartialTest {

  #[@test]
  public function without_members() {
    $fixture= $this->declareType([], '{
      use <T>\with\lang\partial\HashCode;
    }');
    $instance= $fixture->newInstance();
    $this->assertEquals(spl_object_hash($instance), $instance->hashCode());
  }

  #[@test]
  public function with_one_member() {
    $this->fixture= $this->declareType([], '{
      use <T>\with\lang\partial\HashCode;

      private $name;
      public function __construct($name) {
        $this->name= $name;
      }
    }');
    $this->assertEquals(
      '584a08b7760143f05f1323e14f05bf41',
      $this->fixture->newInstance('Test')->hashCode()
    );
  }

  #[@test]
  public function with_multiple_members() {
    $this->fixture= $this->declareType([], '{
      use <T>\with\lang\partial\HashCode;

      private $id, $name, $skills;
      public function __construct($id, $name, $skills= []) {
        $this->id= $id;
        $this->name= $name;
        $this->skills= $skills;
      }
    }');
    $this->assertEquals(
      '01f3f5d557a54b5d6122addbb06b46e1',
      $this->fixture->newInstance(6100, 'Test', ['Dev'])->hashCode()
    );
  }
}