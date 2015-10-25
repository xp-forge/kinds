<?php namespace lang\partial\unittest;

use util\Objects;
use lang\partial\Accessors;
use lang\partial\ToString;
use lang\partial\Equals;
use lang\partial\Builder;

/**
 * Used by InstanceCreationTest
 */
class Book extends \lang\Object {
  use Book\including\Accessors;
  use Book\including\ToString;
  use Book\including\Equals;
  use Book\including\Builder;

  private $name, $author, $isbn;

  /**
   * Creates a new book
   *
   * @param  string $name
   * @param  lang.partial.unittest.Author $author
   * @param  lang.partial.unittest.Isbn $isbn
   */
  public function __construct($name, Author $author, Isbn $isbn= null) {
    $this->name= $name;
    $this->author= $author;
    $this->isbn= $isbn;
  }
}