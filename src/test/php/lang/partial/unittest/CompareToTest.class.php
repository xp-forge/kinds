<?php namespace lang\partial\unittest;

use lang\Value;

class CompareToTest extends PartialTest {
  private $fixture;

  /** @return void */
  public function setUp() {
    $this->fixture= $this->declareType(['lang.Value'], '{
      use <T>\with\lang\partial\CompareTo;

      private $id, $name, $skills;
      public function __construct($id, $name, $skills= []) {
        $this->id= $id;
        $this->name= $name;
        $this->skills= $skills;
      }

      public function hashCode() { /* TBI */ }
      public function toString() { /* TBI */ }
    }');
  }

  #[@test]
  public function compare_to_itself() {
    $instance= $this->fixture->newInstance(6100, 'Test', ['Dev']);
    $this->assertEquals(0, $instance->compareTo($instance));
  }

  #[@test, @values(['Test', new Named('Test')])]
  public function compare_to_instance_with_equal_members($name) {
    $a= $this->fixture->newInstance(6100, $name, ['Dev']);
    $b= $this->fixture->newInstance(6100, $name, ['Dev']);
    $this->assertEquals(0, $a->compareTo($b));
  }

  #[@test]
  public function compare_to_instance_with_smaller_value() {
    $a= $this->fixture->newInstance(6100, new Named('Alphabet'));
    $b= $this->fixture->newInstance(6100, new Named('Zebra'));
    $this->assertEquals(-1, $a->compareTo($b));
  }

  #[@test]
  public function compare_to_instance_with_larger_value() {
    $a= $this->fixture->newInstance(6100, new Named('Zebra'));
    $b= $this->fixture->newInstance(6100, new Named('Alphabet'));
    $this->assertEquals(1, $a->compareTo($b));
  }

  #[@test, @values([
  #  [61, 'Zebra', ['Dev']],
  #  [6100, 'Alphabet', ['Dev']],
  #  [6100, 'Zebra', []],
  #  [61, 'Alphabet', []]
  #])]
  public function b_is_smaller_than($id, $name, $skills) {
    $a= $this->fixture->newInstance(6100, 'Zebra', ['Dev']);
    $b= $this->fixture->getConstructor()->newInstance([$id, $name, $skills]);
    $this->assertEquals(1, $a->compareTo($b));
  }

  #[@test, @values([
  #  [61000, 'Alphabet', ['Dev']],
  #  [6100, 'Zebra', ['Dev']],
  #  [6100, 'Alphabet', ['Dev', 'Gfx']],
  #  [61000, 'Zebra', []]
  #])]
  public function b_is_larger_than($id, $name, $skills) {
    $a= $this->fixture->newInstance(6100, 'Alphabet', ['Dev']);
    $b= $this->fixture->getConstructor()->newInstance([$id, $name, $skills]);
    $this->assertEquals(-1, $a->compareTo($b));
  }

  #[@test]
  public function compare_to_this() {
    $this->assertEquals(1, $this->fixture->newInstance(6100, 'Test', ['Dev'])->compareTo($this));
  }

  #[@test, @values([null, true, false, '', 1, 1.5, [[]], [['key' => 'value']]])]
  public function compare_to_equal($value) {
    $this->assertEquals(1, $this->fixture->newInstance(6100, 'Test', ['Dev'])->compareTo($value));
  }
}