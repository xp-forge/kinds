<?php namespace lang\partial\unittest;

use util\Date;
use lang\partial\Accessors;
use lang\partial\ToString;
use lang\partial\Equals;
use lang\partial\Comparators;

/**
 * Used as fixture in the "ValueObjectTest" class
 */
class Post extends \lang\Object {
  use Post\including\Accessors;
  use Post\including\ToString;
  use Post\including\Equals;
  use Post\including\Comparators;

  private $author, $text, $date;

  public function __construct($author, $text, Date $date) {
    $this->author= $author;
    $this->text= $text;
    $this->date= $date;
  }
}
