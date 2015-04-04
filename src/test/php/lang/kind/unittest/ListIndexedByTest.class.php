<?php namespace lang\kind\unittest;

use lang\ElementNotFoundException;

class ListIndexedByTest extends \unittest\TestCase {

  #[@test]
  public function named() {
    $this->assertEquals($this, (new Tests($this))->named($this->getName()));
  }

  #[@test, @expect(ElementNotFoundException::class)]
  public function named_raises_exceptions() {
    (new Tests())->named($this->getName());
  }

  #[@test]
  public function first() {
    $this->assertEquals($this, (new Tests($this))->first());
  }

  #[@test, @expect(ElementNotFoundException::class)]
  public function first_raises_exception_when_empty() {
    (new Tests())->first();
  }

  #[@test]
  public function provides_returns_true_for_existing_elements() {
    $this->assertTrue((new Tests($this))->provides($this->getName()));
  }

  #[@test]
  public function provides_returns_false_when_element_does_not_exist() {
    $this->assertFalse((new Tests())->provides($this->getName()));
  }

  #[@test]
  public function present_if_not_empty() {
    $this->assertTrue((new Tests($this))->present());
  }

  #[@test]
  public function present_when_empty() {
    $this->assertFalse((new Tests())->present());
  }

  #[@test]
  public function size() {
    $this->assertEquals(1, (new Tests($this))->size());
  }

  #[@test]
  public function can_be_iterated() {
    $this->assertEquals(
      [$this],
      iterator_to_array((new Tests($this)))
    );
  }

  #[@test]
  public function is_equal_to_itself() {
    $fixture= new Tests($this);
    $this->assertEquals($fixture, $fixture);
  }

  #[@test]
  public function is_equal_to_list_with_same_elements() {
    $this->assertEquals(new Tests($this), new Tests($this));
  }

  #[@test]
  public function is_not_equal_to_list_of_different_length() {
    $this->assertNotEquals(
      new Tests(),
      new Tests($this)
    );
  }

  #[@test]
  public function is_not_equal_to_list_with_different_elements() {
    $this->assertNotEquals(
      new Tests($this),
      new Tests(newinstance('unittest.TestCase', ['test'], ['test' => function() { }])
    ));
  }
}