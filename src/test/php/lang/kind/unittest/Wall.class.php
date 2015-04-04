<?php namespace lang\kind\unittest;

/**
 * Used as fixture in the "ValueObjectTest" class
 */
class Wall extends \lang\Object {
  use \lang\kind\ValueObject‹lang\kind\unittest\Wall›;
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
}