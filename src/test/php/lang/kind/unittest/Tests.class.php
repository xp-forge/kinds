<?php namespace lang\kind\unittest;

/**
 * Used as fixture in the "ListIndexedByTest" class
 */
class Tests extends \lang\Object implements \IteratorAggregate {
  use \lang\kind\ListIndexedBy;

  protected function index($test) { return $test->getName(); }
}