<?php namespace lang\partial\unittest;

use util\Date;
use lang\partial\Accessors;
use lang\partial\Comparators;

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
