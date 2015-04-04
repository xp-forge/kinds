<?php namespace lang\kind\unittest;

use util\Objects;

/**
 * Used by InstanceCreationTest
 */
class Book extends Entity {
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

  /** @return string */
  public function name() { return $this->name; }

  /** @return lang.kind.unittest.Author */
  public function author() { return $this->author; }

  /** @return lang.kind.unittest.Isbn */
  public function isbn() { return $this->isbn; }

}