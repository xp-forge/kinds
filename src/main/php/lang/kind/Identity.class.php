<?php namespace lang\kind;

use util\Objects;

trait Identity {
  private $value;

  /**
   * Creates a new identity
   *
   * @param  var $value
   */
  public function __construct($value) {
    $this->value= $value;
  }

  /** @return var */
  public function value() { return $this->value; }

  /**
   * Returns whether a given value is equal to this value
   *
   * @param  var $cmp
   * @return bool
   */
  public function equals($cmp) {
    return $cmp instanceof self && Objects::equal($this->value, $cmp->value);
  }

  /**
   * Creates a string representation
   *
   * @return string
   */
  public function toString() {
    return $this->getClassName().'('.Objects::stringOf($this->value).')';
  }
}