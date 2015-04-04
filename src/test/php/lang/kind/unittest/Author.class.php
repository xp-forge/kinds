<?php namespace lang\kind\unittest;

/**
 * Used by InstanceCreationTest
 */
class Author extends Entity {
  private $name;

  /**
   * Creates a new author
   *
   * @param  string $name
   */
  public function __construct($name) {
    $this->name= $name;
  }

  /** @return string */
  public function name() { return $this->name; }

}