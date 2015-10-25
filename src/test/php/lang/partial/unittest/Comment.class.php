<?php namespace lang\partial\unittest;

use util\Date;
use lang\partial\Accessors;
use lang\partial\ToString;
use lang\partial\Equals;

/**
 * Used as fixture in the "ValueObjectTest" class
 */
class Comment extends \lang\Object {
  use Comment\including\Accessors;
  use Comment\including\ToString;
  use Comment\including\Equals;

  private $author, $text, $date;

  public function __construct($author, $text, Date $date) {
    $this->author= $author;
    $this->text= $text;
    $this->date= $date;
  }

  /** @return string */
  public function text() { return 'Comment: '.$this->text; }
}
