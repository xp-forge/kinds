<?php namespace lang\kind\unittest;

use util\Objects;

/**
 * Used by InstanceCreationTest
 */
class Book extends \lang\Object {
  use \lang\kind\ValueObject»lang\kind\unittest\Book;
  use \lang\kind\WithCreation»lang\kind\unittest\Book;
  private $name, $author, $isbn;

  /**
   * Creates a new book
   *
   * @param  string $name
   * @param  lang.kind.unittest.Author $author
   * @param  lang.kind.unittest.Isbn $isbn
   */
  public function __construct($name, Author $author, Isbn $isbn= null) {
    $this->name= $name;
    $this->author= $author;
    $this->isbn= $isbn;
  }
}