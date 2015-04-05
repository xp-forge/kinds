<?php namespace lang\kind;

class Comparator extends \lang\Object implements \util\Comparator {
  private $field;

  /**
   * Creates a new comparator
   *
   * @param  string $field
   */
  public function __construct($field) {
    $this->field= $field;
  }

  /**
   * Compares two instances, a and b, created by the "Comparators" transformation.
   *
   * @param  var $a
   * @param  var $b
   */
  public function compare($a, $b) {
    return $a->compareUsing($b, $this->field);
  }
}