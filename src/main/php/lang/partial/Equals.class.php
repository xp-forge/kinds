<?php namespace lang\partial;

/**
 * The compile-time `Equals` transformation generates an equals method
 * which compares member-wise using `Objects::equal()`
 *
 * @see   xp://util.Objects
 * @test  xp://lang.partial.unittest.EqualsTest
 */
class Equals extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return string
   */
  protected function body($mirror) {
    $compare= '';
    foreach ($this->instanceFields($mirror) as $field) {
      $n= $field->name();
      $compare.= '&& \util\Objects::equal($this->'.$n.', $cmp->'.$n.')';
    }
    return 'public function equals($cmp) { return $cmp instanceof self '.$compare.'; }';
  }
}