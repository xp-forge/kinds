<?php namespace lang\partial\unittest;

use lang\partial\{Accessors, Comparators};
use util\Date;

/**
 * Used as fixture in the "ValueObjectTest" class
 */
class Post {
  use Post\including\Accessors;
  use Post\including\Comparators;

  private $author, $text, $date;

  public function __construct($author, $text, Date $date) {
    $this->author= $author;
    $this->text= $text;
    $this->date= $date;
  }
}