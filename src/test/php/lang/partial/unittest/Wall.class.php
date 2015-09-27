<?php namespace lang\partial\unittest;

use lang\partial\Accessors;
use lang\partial\ToString;
use lang\partial\Equals;

/**
 * Used as fixture in the "AccessorsTest" class
 */
class Wall extends \lang\Object {
  use Wall\including\Accessors;
  use Wall\including\ToString;
  use Wall\including\Equals;

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