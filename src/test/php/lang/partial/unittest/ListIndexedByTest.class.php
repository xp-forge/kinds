<?php namespace lang\partial\unittest;

use lang\ElementNotFoundException;
use unittest\{Expect, Test, TestCase};

class ListIndexedByTest extends TestCase {

  #[Test]
  public function named() {
    $this->assertEquals($this, (new Tests($this))->named($this->getName()));
  }

  #[Test, Expect(ElementNotFoundException::class)]
  public function named_raises_exceptions() {
    (new Tests())->named($this->getName());
  }

  #[Test]
  public function first() {
    $this->assertEquals($this, (new Tests($this))->first());
  }

  #[Test, Expect(ElementNotFoundException::class)]
  public function first_raises_exception_when_empty() {
    (new Tests())->first();
  }

  #[Test]
  public function provides_returns_true_for_existing_elements() {
    $this->assertTrue((new Tests($this))->provides($this->getName()));
  }

  #[Test]
  public function provides_returns_false_when_element_does_not_exist() {
    $this->assertFalse((new Tests())->provides($this->getName()));
  }

  #[Test]
  public function present_if_not_empty() {
    $this->assertTrue((new Tests($this))->present());
  }

  #[Test]
  public function present_when_empty() {
    $this->assertFalse((new Tests())->present());
  }

  #[Test]
  public function size() {
    $this->assertEquals(1, (new Tests($this))->size());
  }

  #[Test]
  public function can_be_iterated() {
    $this->assertEquals(
      [$this->getName() => $this],
      iterator_to_array((new Tests($this)))
    );
  }

  #[Test]
  public function is_equal_to_itself() {
    $fixture= new Tests($this);
    $this->assertEquals($fixture, $fixture);
  }

  #[Test]
  public function is_equal_to_list_with_same_elements() {
    $this->assertEquals(new Tests($this), new Tests($this));
  }

  #[Test]
  public function is_not_equal_to_list_of_different_length() {
    $this->assertNotEquals(
      new Tests(),
      new Tests($this)
    );
  }

  #[Test]
  public function is_not_equal_to_list_with_different_elements() {
    $this->assertNotEquals(
      new Tests($this),
      new Tests(new class('test') extends TestCase {
        public function test() { }
      })
    );
  }

  #[Test]
  public function indexed_can_be_accessed() {
    $tests= new class(['this' => $this]) extends Tests {
      public function __construct($indexed) { $this->indexed= $indexed; }
    };
    $this->assertEquals($this, $tests->named('this'));
  }
}