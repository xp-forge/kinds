<?php namespace lang\partial;

/**
 * Compile-time `Accessors` transformation which generates public accessors
 * based on fields included in your class definition.
 *
 * @test  xp://lang.partial.unittest.AccessorsTest
 */
class AccessorsV7 extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return string
   */
  protected function body($mirror) {
    $unit= '';
    $get= '';
    foreach ($this->instanceFields($mirror) as $field) {
      $unit.= '/** @return '.$field->type().' */';

      $name= $field->name();
      $unit.= 'public function '.$name.'() { return $this->'.$name.'; }';
    }
    return $unit;
  }
}