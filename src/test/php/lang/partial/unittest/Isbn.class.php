<?php namespace lang\partial\unittest;

use util\Objects;
use lang\partial\Accessors;
use lang\partial\Value;
use lang\partial\Builder;

/**
 * Used by InstanceCreationTest
 */
class Isbn implements \lang\Value {
  const EAN13 = 13;

  use Isbn\is\Value;
  use Isbn\including\Accessors;
  use Isbn\including\Builder;

  private $number, $type;

  /**
   * Creates a new author
   *
   * @param  string $number
   * @param  int $type
   */
  public function __construct($number, $type= self::EAN13) {
    $this->number= $number;
    $this->type= $type;
  }

  /** @return string */
  public function number() { return $this->number; }

  /** @return int */
  public function type() { return $this->type; }

  /**
   * Overwritten comparison method
   *
   * @param  var $value
   * @return int
   */
  public function compareTo($value) {
    return $value instanceof self
      ? Objects::compare([$this->number, $this->type], [$value->number, $value->type])
      : 1
    ;
  }
}