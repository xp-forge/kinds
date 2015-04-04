<?php namespace lang\kind;

use lang\IllegalStateException;
use lang\ElementNotFoundException;
use util\Objects;

/**
 * The `ListIndexedBy` trait creates a list of elements which can be queried by
 * name, also creating `equals()` and `toString()` in a sensible manner.
 *
 * @test  xp://lang.kind.unittest.ListIndexedByTest
 */
trait ListIndexedBy {
  private $indexed= [];

  /**
   * Constructor
   *
   * @param  var* $elements
   */
  public function __construct(...$elements) {
    foreach ($elements as $element) {
      $this->indexed[$this->index($element)]= $element;
    }
  }

  /**
   * Overwritten by implementations: Return an index for a given element.
   *
   * @param  var $element
   * @return string
   */
  protected abstract function index($element);

  /**
   * Returns whether elements are present
   *
   * @return bool
   */
  public function present() {
    return !empty($this->indexed);
  }

  /**
   * Returns whether this list provides an element for a given name
   *
   * @param  string $name
   * @return bool
   */
  public function provides($name) {
    return isset($this->indexed[$name]);
  }

  /**
   * Returns the element for a given name.
   *
   * @param  string $name
   * @return var
   * @throws lang.ElementNotFoundException
   */
  public function named($name) {
    if (isset($this->indexed[$name])) {
      return $this->indexed[$name];
    }
    throw new ElementNotFoundException('No element named "'.$name.'"');
  }

  /**
   * Returns the first element.
   *
   * @return var
   * @throws lang.ElementNotFoundException
   */
  public function first() {
    if (empty($this->indexed)) {
      throw new ElementNotFoundException('No elements');
    }
    return $this->indexed[key($this->indexed)];
  }

  /**
   * Overloads iteration
   *
   * @return  php.Iterator
   */
  public function getIterator() {
    foreach ($this->indexed as $element) {
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
    return $cmp instanceof self && Objects::equal($this->indexed, $cmp->indexed);
  }

  /**
   * Creates a string representation
   *
   * @return string
   */
  public function toString() {
    return $this->getClassName().'@'.Objects::stringOf($this->indexed);
  }
}