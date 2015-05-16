<?php namespace lang\partial;

/**
 * Compile-time `WithCreation` transformation which generates a fluent interface
 * for creating instances.
 * 
 * ```php
 * use lang\partial\WithCreation;
 *
 * class Example extends \lang\Object {
 *   use Example\including\WithCreation;
 *   private $name, $id;
 *
 *   public function __construct($name, $id) {
 *     $this->name= $name;
 *     $this->id= $id;
 *   }
 * }
 * ```
 *
 * Instances of the above class can now be generated either by invoking its
 * constructor or by using the `with()` method:
 *
 * ```php
 * $example= Example::with()->name('Test')->id(6100)->create();
 * ```
 */
class WithCreation extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return string
   */
  protected function body($mirror) {
    return 'public static function with() {
      return \lang\partial\InstanceCreation::of(new \lang\XPClass(\''.strtr($mirror->name(), '.', '\\').'\'));
    }';
  }
}