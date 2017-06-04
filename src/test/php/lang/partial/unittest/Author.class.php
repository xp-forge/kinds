<?php namespace lang\partial\unittest;

use lang\partial\Accessors;
use lang\partial\Builder;

/**
 * Used by InstanceCreationTest
 */
class Author {
  use Author\including\Accessors;
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