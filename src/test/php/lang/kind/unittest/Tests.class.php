<?php namespace lang\kind\unittest;

use lang\kind\ListIndexedBy;

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