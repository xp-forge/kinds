<?php namespace lang\partial;

use util\Objects;

/**
 * The `Box` trait creates a value object wrapping around exactly one member,
 * including `equals()`, `hashCode()` and `compareTo()` methods. The default
 * method for accessing the underlying value can be aliased when using the trait,
 * e.g. `use Named\is\Box { value as name; }`.
 *
 * This implementation is a special optimized implementation of the `Value`
 * trait, which works for any amount of members.
 *
 * @see   xp://lang.partial.Value
 * @test  xp://lang.partial.unittest.BoxTest
 */
trait Box {
  protected $value;

  /**
   * Creates a new reference to a given value
   *
   * @param  var $value
   */
  public function __construct($value) {
    $this->value= $value;
  }

  /** @return var */
  public function value() { return $this->value; }

  /**
   * Returns a hashcode for this boxed value
   *
   * @return string
   */
  public function hashCode() {
    return 'b$'.Objects::hashOf($this->value);
  }

  /**
   * Returns whether a given value is equal to this value
   *
   * @param  var $cmp
   * @return bool
   */
  public function compareTo($cmp) {
    return Objects::compare($this->value, $cmp->value);
  }

  /**
   * Creates a string representation
   *
   * @return string
   */
  public function toString() {
    return nameof($this).'('.Objects::stringOf($this->value).')';
  }
}