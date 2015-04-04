<?php namespace lang\kind\transformation;

/**
 * Compile-time transformation.
 */
abstract class Transformation extends \lang\Object {
  protected $base;

  /**
   * Creates new transformation instance for a given base type
   *
   * @param  lang.XPClass $base
   */
  public function __construct($base) { $this->base= $base; }

  /**
   * Creates trait body
   *
   * @param  lang.XPClass
   * @return string
   */
  protected abstract function unit($class);

  /**
   * Transforms class
   *
   * @param  lang.XPClass
   * @return string
   */
  public function transform($class) {
    return 'use \\'.$this->base->literal().'; '.$this->unit($class);
  }
}