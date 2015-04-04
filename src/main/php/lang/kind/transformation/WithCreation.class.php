<?php namespace lang\kind\transformation;

/**
 * Compile-time `WithCreation` transformation which generates a fluent interface
 * for creating instances.
 * 
 * ```php
 * class Example extends \lang\Object {
 *   use \lang\kind\WithCreation‹namespace\of\Example›;
 *   private $name, $id;
 *
 *   public function __construct($name, $id) {
 *     $this->name= $name;
 *     $this->id= $id;
 *   }
 * }
 * ```
 *
 * In the above example, a `name()` and `id()` method are generated.
 */
class WithCreation extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.XPClass
   * @return string
   */
  protected function unit($class) {
    return 'public static function with() {
      return \lang\kind\InstanceCreation::of(new \lang\XPClass(\''.$class->literal().'\'));
    }';
  }
}