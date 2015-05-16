<?php namespace lang\partial\unittest;

use lang\partial\ListIndexedBy;

/**
 * Used as fixture in the "ListIndexedByTest" class
 */
class Tests extends \lang\Object implements \IteratorAggregate {
  use ListIndexedBy;

  /**
   * Calculate index
   *
   * @param  unittest.TestCase $test
   * @return string
   */
  protected function index($test) { return $test->getName(); }
}