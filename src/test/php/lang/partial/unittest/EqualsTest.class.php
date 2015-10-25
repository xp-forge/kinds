<?php namespace lang\partial\unittest;

class EqualsTest extends PartialTest {
  private $fixture;

  /** @return void */
  public function setUp() {
    $this->fixture= $this->declareType([], '{
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
    $this->assertTrue($instance->equals($instance));
  }

  #[@test]
  public function equals_instance_with_equal_members() {
    $a= $this->fixture->newInstance(6100, 'Test', ['Dev']);
    $b= $this->fixture->newInstance(6100, 'Test', ['Dev']);
    $this->assertTrue($a->equals($b));
  }

  #[@test, @values([
  #  [61, 'Test', ['Dev']],
  #  [6100, 'Other', ['Dev']],
  #  [6100, 'Test', []],
  #  [61, 'Other', []]
  #])]
  public function does_not_equal_instance_with_unequal_members($id, $name, $skills) {
    $a= $this->fixture->newInstance(6100, 'Test', ['Dev']);
    $b= $this->fixture->getConstructor()->newInstance([$id, $name, $skills]);
    $this->assertFalse($a->equals($b));
  }

  #[@test]
  public function does_not_equal_this() {
    $this->assertFalse($this->fixture->newInstance(6100, 'Test', ['Dev'])->equals($this));
  }

  #[@test, @values([null, true, false, '', 1, 1.5, [[]], [['key' => 'value']]])]
  public function does_not_equal($value) {
    $this->assertFalse($this->fixture->newInstance(6100, 'Test', ['Dev'])->equals($value));
  }
}