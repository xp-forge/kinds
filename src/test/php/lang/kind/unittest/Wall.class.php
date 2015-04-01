<?php namespace lang\kind\unittest;

/**
 * Used as fixture in the "ValTest" class
 */
class Wall extends \lang\Object {
  use \lang\kind\Val;
  private $name, $type;

  public function __construct($name, $type) {
    $this->name= $name;
    $this->type= $type;
  }

  public function name() { return $this->name; }

  public function type() { return $this->type; }
}