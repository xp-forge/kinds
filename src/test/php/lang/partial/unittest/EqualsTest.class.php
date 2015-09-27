<?php namespace lang\partial\unittest;

class EqualsTest extends PartialTest {
  private $fixture;

  /** @return void */
  public function setUp() {
    $this->fixture= $this->declareType('{
      use <T>\with\lang\partial\Equals;

      private $id, $name, $skills;
      public function __construct($id, $name, $skills= []) {
        $this->id= $id;
        $this->name= $name;
        $this->skills= $skills;
      }
    }');
  }

  #[@test]
  public function equals_itself() {
    $instance= $this->fixture->newInstance(6100, 'Test', ['Dev']);
    $this->assertEquals($instance, $instance);
  }

  #[@test]
  public function equals_instance_with_equal_members() {
    $this->assertEquals(
      $this->fixture->newInstance(6100, 'Test', ['Dev']),
      $this->fixture->newInstance(6100, 'Test', ['Dev'])
    );
  }

  #[@test]
  public function does_not_equal_instance_with_unequal_members() {
    $this->assertNotEquals(
      $this->fixture->newInstance(6100, 'Test', ['Dev']),
      $this->fixture->newInstance(61, 'Other', [])
    );
  }

  #[@test]
  public function does_not_equal_this() {
    $this->assertNotEquals($this->fixture->newInstance(6100, 'Test', ['Dev']), $this);
  }

  #[@test, @values([null, true, false, '', 1, 1.5, [[]], [['key' => 'value']]])]
  public function does_not_equal($value) {
    $this->assertNotEquals($this->fixture->newInstance(6100, 'Test', ['Dev']), $value);
  }
}