<?php namespace lang\partial\unittest;

use lang\partial\ValueObject;
use lang\partial\Builder;

/**
 * Used by InstanceCreationTest
 */
class Author extends \lang\Object {
  use Author\including\ValueObject;
  use Author\including\Builder;

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