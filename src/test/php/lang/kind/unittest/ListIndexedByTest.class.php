<?php namespace lang\kind\unittest;

use lang\kind\ListIndexedBy;
use lang\ElementNotFoundException;

class ListIndexedByTest extends \unittest\TestCase {

  /**
   * Returns a new fixture created from the `ListIndexedBy` trait,
   * using the elements' `getName()` method for indexing.
   *
   * @param  var[] $args
   * @return lang.Generic
   */
  private function newFixture($args) {
    return newinstance('lang.kind.ListIndexedBy', $args, [
      'index' => function($element) { return $element->getName(); }
    ]);
  }

  #[@test]
  public function named() {
    $this->assertEquals($this, $this->newFixture([$this])->named($this->getName()));
  }

  #[@test, @expect(ElementNotFoundException::class)]
  public function named_raises_exceptions() {
    $this->newFixture([])->named($this->getName());
  }

  #[@test]
  public function first() {
    $this->assertEquals($this, $this->newFixture([$this])->first($this->getName()));
  }

  #[@test, @expect(ElementNotFoundException::class)]
  public function first_raises_exception_when_empty() {
    $this->newFixture([])->first($this->getName());
  }

  #[@test]
  public function provides_returns_true_for_existing_elements() {
    $this->assertTrue($this->newFixture([$this])->provides($this->getName()));
  }

  #[@test]
  public function provides_returns_false_when_element_does_not_exist() {
    $this->assertFalse($this->newFixture([])->provides($this->getName()));
  }

  #[@test]
  public function present_if_not_empty() {
    $this->assertTrue($this->newFixture([$this])->present());
  }

  #[@test]
  public function present_when_empty() {
    $this->assertFalse($this->newFixture([])->present());
  }

  #[@test]
  public function can_be_iterated() {
    $this->assertEquals(
      [$this],
      iterator_to_array($this->newFixture([$this])->getIterator())
    );
  }

  #[@test]
  public function is_equal_to_itself() {
    $fixture= $this->newFixture([$this]);
    $this->assertEquals($fixture, $fixture);
  }

  #[@test]
  public function is_equal_to_list_with_same_elements() {
    $this->assertNotEquals(
      $this->newFixture([$this]),
      $this->newFixture([$this])
    );
  }

  #[@test]
  public function is_not_equal_to_list_of_different_length() {
    $this->assertNotEquals(
      $this->newFixture([]),
      $this->newFixture([$this])
    );
  }

  #[@test]
  public function is_not_equal_to_list_with_different_elements() {
    $this->assertNotEquals(
      $this->newFixture([$this]),
      $this->newFixture([newinstance('unittest.TestCase', ['test'], ['test' => function() { }])]
    ));
  }
}