<?php namespace lang\kind;

use lang\IllegalStateException;
use lang\ElementNotFoundException;

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
   * Overloads iteration
   *
   * @return  php.Iterator
   */
  public function getIterator() {
    foreach ($this->indexed as $element) {
      yield $element;
    }
  }
}