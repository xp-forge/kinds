<?php namespace lang\partial\unittest;

use unittest\Test;
use util\Objects;

class HashCodeTest extends PartialTest {

  #[Test]
  public function without_members() {
    $fixture= $this->declareType([], '{
      use <T>\with\lang\partial\HashCode;
    }');
    $instance= $fixture->newInstance();
    $this->assertEquals(spl_object_hash($instance), $instance->hashCode());
  }

  #[Test]
  public function with_one_member() {
    $fixture= $this->declareType([], '{
      use <T>\with\lang\partial\HashCode;

      private $name;
      public function __construct($name) {
        $this->name= $name;
      }
    }');
    $this->assertEquals(
      md5($fixture->getName().Objects::hashOf('Test')),
      $fixture->newInstance('Test')->hashCode()
    );
  }

  #[Test]
  public function with_multiple_members() {
    $fixture= $this->declareType([], '{
      use <T>\with\lang\partial\HashCode;

      private $id, $name, $skills;
      public function __construct($id, $name, $skills= []) {
        $this->id= $id;
        $this->name= $name;
        $this->skills= $skills;
      }
    }');
    $this->assertEquals(
      md5($fixture->getName().Objects::hashOf(6100).Objects::hashOf('Test').Objects::hashOf(['Dev'])),
      $fixture->newInstance(6100, 'Test', ['Dev'])->hashCode()
    );
  }
}