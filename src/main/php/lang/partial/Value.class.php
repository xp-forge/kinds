<?php namespace lang\partial;

/**
 * The compile-time `Value` transformation creates `lang.Value` instances:
 *
 * - A constructor to set all members, in the order of their declaration
 * - Accessors for reading all members
 * - Implementations of `hashCode()`, `compareTo()`  and `toString()`
 *
 * @test  xp://lang.partial.unittest.ValueTest
 */
class Value extends Aggregate {

  /** @return lang.partial.Transformation[] */
  protected function transformations() {
    return [new Constructor(), new Accessors(), new HashCode(), new CompareTo(), new ToString()];
  }
}