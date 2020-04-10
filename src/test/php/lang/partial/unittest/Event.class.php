<?php namespace lang\partial\unittest;

use lang\partial\{Accessors, Builder};

/**
 * Used by InstanceCreationTest
 */
class Event {
  use Event\including\Accessors;
  use Event\including\Builder;

  private $name, $class;

  /**
   * Creates a new event
   *
   * @param  string $name
   * @param  string $class
   */
  public function __construct($name, $class) {
    $this->name= $name;
    $this->class= $class;
  }
}