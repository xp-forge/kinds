<?php namespace lang\kind\transform;

/**
 * Compile-time transformation.
 */
abstract class Transformation extends \lang\Object {

  /**
   * Creates trait body
   *
   * @param  lang.XPClass
   * @return string
   */
  protected abstract function body($class);

  /**
   * Transforms class
   *
   * @param  lang.XPClass
   * @return string
   */
  public function transform($class) {
    return $this->body($class);
  }
}