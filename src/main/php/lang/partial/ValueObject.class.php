<?php namespace lang\partial;

/**
 * Compile-time `ValueObject` transformation which generates public accessors
 * based on fields included in your class definition as well as equals() and 
 * toString() methods.
 *
 * Include this transformation in your class as follows:
 * 
 * ```php
 * class Example extends \lang\Object {
 *   use \lang\partial\ValueObject»namespace\of\Example;
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
      $unit.= 'public function '.$field->name().'() { return $this->'.$field->name().'; }';
    }

    // equals()
    $unit.= 'public function equals($cmp) {
      if ($cmp instanceof self) {
        $thisVars= (array)$this;
        $cmpVars= (array)$cmp;
        unset($thisVars[\'__id\'], $cmpVars[\'__id\']);
        return \util\Objects::equal($thisVars, $cmpVars);
      }
      return false;
    }';

    // toString()
    $unit.= 'public function toString() {
      $thisVars= get_object_vars($this);
      unset($thisVars[\'__id\']);
      return $this->getClassName().\'@\'.\util\Objects::stringOf($thisVars);
    }';

    return $unit;
  }
}