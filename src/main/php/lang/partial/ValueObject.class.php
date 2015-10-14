<?php namespace lang\partial;

use lang\Primitive;
use lang\Type;

/**
 * Compile-time `ValueObject` transformation which generates public accessors
 * based on fields included in your class definition as well as equals() and 
 * toString() methods.
 *
 * Include this transformation in your class as follows:
 * 
 * ```php
 * use lang\partial\ValueObject;
 *
 * class Example extends \lang\Object {
 *   use Example\including\ValueObject;
 *
 *   private $name, $id;
 * }
 * ```
 *
 * In the above example, a `name()` and `id()` method are generated.
 *
 * @test  xp://lang.partial.unittest.ValueObjectTest
 */
class ValueObject extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return string
   */
  protected function body($mirror) {
    $unit= '';
    foreach ($this->instanceFields($mirror) as $field) {
      $unit.= $this->newMethod($field->name(), [], $field->type(), 'return $this->'.$field->name().';');
    }

    // equals()
    $unit.= $this->newMethod('equals', ['cmp' => Type::$VAR], Primitive::$BOOL, '
      if ($cmp instanceof self) {
        $thisVars= (array)$this;
        $cmpVars= (array)$cmp;
        unset($thisVars[\'__id\'], $cmpVars[\'__id\']);
        return \util\Objects::equal($thisVars, $cmpVars);
      }
      return false;
    ');

    // toString()
    $unit.= $this->newMethod('toString', [], Primitive::$STRING, '
      $thisVars= get_object_vars($this);
      unset($thisVars[\'__id\']);
      return $this->getClassName().\'@\'.\util\Objects::stringOf($thisVars);
    ');

    return $unit;
  }
}