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
      '13ad597c2d2166d7300c775014a6c15a',
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
      'b07c14abc96e863a7ba4d0be785cb583',
      $this->fixture->newInstance(6100, 'Test', ['Dev'])->hashCode()
    );
  }
}