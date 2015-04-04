<?php namespace lang\kind\transformation;

/**
 * Compile-time `ValueObject` transformation which generates public accessors
 * based on fields included in your class definition. Include this transformation
 * in your class as follows:
 * 
 * ```php
 * class Example extends \lang\Object {
 *   use \lang\kind\ValueObject‹namespace\of\Example›;
 *   private $name, $id;
 * }
 * ```
 *
 * In the above example, a `name()` and `id()` method are generated.
 */
class ValueObject extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.XPClass
   * @return string
   */
  protected function body($class) {
    $unit= '';
    foreach ($class->getFields() as $field) {
      if (!($field->getModifiers() & MODIFIER_STATIC)) {
        $unit.= 'public function '.$field->getName().'() { return $this->'.$field->getName().'; }';
      }
    }
    return $unit;
  }
}