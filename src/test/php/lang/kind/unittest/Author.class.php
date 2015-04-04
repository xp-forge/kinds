<?php namespace lang\kind\unittest;

/**
 * Used by InstanceCreationTest
 */
class Author extends \lang\Object {
  use \lang\kind\ValueObject‹lang\kind\unittest\Author›;
  use \lang\kind\WithCreation‹lang\kind\unittest\Author›;
  private $name;

  /**
   * Creates a new author
   *
   * @param  string $name
   */
  public function __construct($name) {
    $this->name= $name;
  }
}