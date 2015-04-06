<?php namespace lang\kind\unittest;

/**
 * Used as fixture in the "ValueObjectTest" class
 */
class Wall extends \lang\Object {
  use \lang\kind\ValueObject»lang\kind\unittest\Wall;
  private $name, $type, $posts;

  /**
   * Constructor
   *
   * @param  string $name
   * @param  string $type
   * @param  lang.kind.unittest.Post[] $posts
   */
  public function __construct($name, $type, array $posts) {
    $this->name= $name;
    $this->type= $type;
    $this->posts= $posts;
  }
}