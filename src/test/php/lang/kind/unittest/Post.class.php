<?php namespace lang\kind\unittest;

use util\Date;

/**
 * Used as fixture in the "ValueObjectTest" class
 */
class Post extends \lang\Object {
  use \lang\kind\ValueObject»lang\kind\unittest\Post;
  use \lang\kind\Comparators»lang\kind\unittest\Post;
  private $author, $text, $date;

  public function __construct($author, $text, Date $date) {
    $this->author= $author;
    $this->text= $text;
    $this->date= $date;
  }
}