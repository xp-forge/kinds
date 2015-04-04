<?php namespace lang\kind;

use lang\IllegalStateException;
use lang\ElementNotFoundException;
use util\Objects;

/**
 * The `ListOf` trait creates a list of elements which can be queried by
 * offset, also creating `equals()` and `toString()` in a sensible manner.
 *
 * @test  xp://lang.kind.unittest.ListOfTest
 */
trait ListOf {
  private $backing= [];

  /**
   * Constructor
   *
   * @param  var* $elements
   */
  public function __construct(...$elements) {
    $this->backing= $elements;
  }

  /**
   * Returns whether elements are present
   *
   * @return bool
   */
  public function present() {
    return !empty($this->backing);
  }

  /**
   * Returns how many elements exist
   *
   * @return bool
   */
  public function size() {
    return sizeof($this->backing);
  }

  /**
   * Returns the element for a given name.
   *
   * @param  int $offset
   * @return var
   * @throws lang.ElementNotFoundException
   */
  public function at($offset) {
    if (isset($this->backing[$offset])) {
      return $this->backing[$offset];
    }
    throw new ElementNotFoundException('No element at offset '.$offset);
  }

  /**
   * Returns the first element.
   *
   * @return var
   * @throws lang.ElementNotFoundException
   */
  public function first() {
    if (empty($this->backing)) {
      throw new ElementNotFoundException('No elements');
    }
    return $this->backing[0];
  }

  /**
   * Overloads iteration
   *
   * @return  php.Iterator
   */
  public function getIterator() {
    foreach ($this->backing as $element) {
      yield $element;
    }
  }

  /**
   * Returns whether a given value is equal to this list
   *
   * @param  var $cmp
   * @return bool
   */
  public function equals($cmp) {
    return $cmp instanceof self && Objects::equal($this->backing, $cmp->backing);
  }

  /**
   * Creates a string representation
   *
   * @return string
   */
  public function toString() {
    return $this->getClassName().'@'.Objects::stringOf($this->backing);
  }
}