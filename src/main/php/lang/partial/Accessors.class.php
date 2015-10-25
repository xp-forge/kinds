<?php namespace lang\partial;

/**
 * Compile-time `Accessors` transformation which generates public accessors
 * based on fields included in your class definition.
 * *
 * @test  xp://lang.partial.unittest.AccessorsTest
 */
class Accessors extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return string
   */
  protected function body($mirror) {
    $unit= '';
    foreach ($this->instanceFields($mirror) as $field) {
      $unit.= '/** @return '.$field->type().' */';
      $unit.= 'public function '.$field->name().'() { return $this->'.$field->name().'; }';
    }
    return $unit;
  }
}