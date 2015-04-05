<?php namespace lang\kind\unittest;

class ComparatorsTest extends \unittest\TestCase {

  #[@test]
  public function byFirstName() {
    $this->assertInstanceOf('util.Comparator', Person::byFirstName());
  }

  #[@test]
  public function byLastName() {
    $this->assertInstanceOf('util.Comparator', Person::byLastName());
  }

  #[@test]
  public function byBirthDate() {
    $this->assertInstanceOf('util.Comparator', Person::byBirthDate());
  }

  #[@test, @values([['Same', 'Same'], ['Same', 'Different'], ['Different', 'Same']])]
  public function compare_using_byFirstName($lastA, $lastB) {
    $this->assertEquals(-1, Person::byFirstName()->compare(
      new Person('A', $lastA, 1977),
      new Person('B', $lastB, 1977)
    ));
  }

  #[@test, @values([['Same', 'Same'], ['Same', 'Different'], ['Different', 'Same']])]
  public function compare_using_byFirstName_object($lastA, $lastB) {
    $this->assertEquals(-1, Person::byFirstName()->compare(
      new Person(new Named('A'), $lastA, 1977),
      new Person(new Named('B'), $lastB, 1977)
    ));
  }
}