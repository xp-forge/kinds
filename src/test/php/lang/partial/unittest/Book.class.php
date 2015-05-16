<?php namespace lang\partial\unittest;

use util\Objects;
use lang\partial\ValueObject;
use lang\partial\WithCreation;

/**
 * Used by InstanceCreationTest
 */
class Book extends \lang\Object {
  use Book\including\ValueObject;
  use Book\including\WithCreation;

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