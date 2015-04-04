<?php namespace lang\kind\unittest;

/**
 * Used as fixture in the "ValueObjectTest" class
 */
class Wall extends \lang\Object {
  use \lang\kind\ValueObject;
  private $name, $type;

  /**
   * Constructor
   *
   * @param  string $name
   * @param  string $type
   */
  public function __construct($name, $type) {
    $this->name= $name;
    $this->type= $type;
  }

  /** @return string */
  public function name() { return $this->name; }

  /** @return string */
  public function type() { return $this->type; }
}