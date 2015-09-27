<?php namespace lang\partial\unittest;

use lang\partial\Accessors;
use lang\partial\ToString;
use lang\partial\Equals;
use lang\partial\Builder;

/**
 * Used by InstanceCreationTest
 */
class Author extends \lang\Object {
  use Author\including\Accessors;
  use Author\including\ToString;
  use Author\including\Equals;
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