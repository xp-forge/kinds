<?php namespace lang\partial\unittest;

use util\Date;
use lang\partial\ValueObject;

/**
 * Used as fixture in the "ValueObjectTest" class
 */
class Comment extends \lang\Object {
  use Comment\including\ValueObject;

  private $author, $text, $date;

  public function __construct($author, $text, Date $date) {
    $this->author= $author;
    $this->text= $text;
    $this->date= $date;
  }

  /** @return string */
  public function text() { return 'Comment: '.$this->text; }
}
