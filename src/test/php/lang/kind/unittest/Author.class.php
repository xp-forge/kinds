<?php namespace lang\kind\unittest;

use lang\kind\ValueObject;
use lang\kind\WithCreation;

/**
 * Used by InstanceCreationTest
 */
class Author extends \lang\Object {
  use Author\including\ValueObject;
  use Author\including\WithCreation;

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