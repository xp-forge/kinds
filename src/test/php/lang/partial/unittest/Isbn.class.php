<?php namespace lang\partial\unittest;

use lang\partial\Accessors;
use lang\partial\ToString;
use lang\partial\Equals;
use lang\partial\Builder;

/**
 * Used by InstanceCreationTest
 */
class Isbn extends \lang\Object {
  const EAN13 = 13;

  use Isbn\including\Accessors;
  use Isbn\including\ToString;
  use Isbn\including\Equals;
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
   * Returns whether a given value equals this instance
   *
   * @param  var $value
   * @return bool
   */
  public function equals($value) {
    return $value instanceof self && $this->number === $value->number && $this->type === $value->type;
  }
}