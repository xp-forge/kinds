<?php namespace lang\kind\unittest;

/**
 * Used as fixture in the "ValTest" class
 */
class Named extends \lang\Object {
  use \lang\kind\Val;
  private $name;

  public function __construct($name) { $this->name= $name; }
  public function name() { return $this->name; }
}