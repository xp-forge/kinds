<?php namespace lang\partial\unittest;

use lang\partial\ValueObject;

/**
 * Used as fixture in the "ValueObjectTest" class
 */
class Wall extends \lang\Object {
  use Wall\including\ValueObject;

  private $name, $type, $posts;

  /**
   * Constructor
   *
   * @param  string $name
   * @param  string $type
   * @param  lang.partial.unittest.Post[] $posts
   */
  public function __construct($name, $type, array $posts) {
    $this->name= $name;
    $this->type= $type;
    $this->posts= $posts;
  }
}