<?php namespace lang\kind\unittest;

use util\Date;
use lang\kind\ValueObject;
use lang\kind\Comparators;

/**
 * Used as fixture in the "ValueObjectTest" class
 */
class Post extends \lang\Object {
  use Post\including\ValueObject;
  use Post\including\Comparators;

  private $author, $text, $date;

  public function __construct($author, $text, Date $date) {
    $this->author= $author;
    $this->text= $text;
    $this->date= $date;
  }
}
