<?php namespace lang\kind\unittest;

/**
 * Used by InstanceCreationTest
 */
class Isbn extends \lang\Object {
  const EAN13 = 13;

  use \lang\kind\ValueObject‹lang\kind\unittest\Isbn›;
  use \lang\kind\WithCreation‹lang\kind\unittest\Isbn›;
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