<?php namespace lang\kind\unittest;

class SortableTest extends \unittest\TestCase {

  #[@test, @values([
  #  ['Timm', 'Test', 1977],
  #  [new Named('Timm'), 'Test', 1977],
  #  [new Named('Timm'), new Named('Test'), 1977]
  #])]
  public function with_same_members($first, $last, $born) {
    $this->assertEquals(0, (new Person($first, $last, $born))->compareTo(new Person($first, $last, $born)));
  }

  #[@test]
  public function with_larger_firstName() {
    $this->assertEquals(-1, (new Person('A', 'Test', 1977))->compareTo(new Person('B', 'Test', 1977)));
  }

  #[@test]
  public function with_smaller_firstName() {
    $this->assertEquals(1, (new Person('B', 'Test', 1977))->compareTo(new Person('A', 'Test', 1977)));
  }

  #[@test]
  public function with_same_firstName_and_larger_lastName() {
    $this->assertEquals(-1, (new Person('Test', 'A', 1977))->compareTo(new Person('Test', 'B', 1977)));
  }

  #[@test]
  public function with_same_firstName_and_smaller_lastName() {
    $this->assertEquals(1, (new Person('Test', 'B', 1977))->compareTo(new Person('Test', 'A', 1977)));
  }

  #[@test]
  public function with_same_first_and_lastNames_and_larger_birthDate() {
    $this->assertEquals(-1, (new Person('Test', 'A', 1977))->compareTo(new Person('Test', 'A', 1978)));
  }

  #[@test]
  public function with_same_first_and_lastNames_and_smaller_birthDate() {
    $this->assertEquals(1, (new Person('Test', 'B', 1977))->compareTo(new Person('Test', 'A', 1976)));
  }
}