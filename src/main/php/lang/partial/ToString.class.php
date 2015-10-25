<?php namespace lang\partial;

/**
 * The compile-time `ToString` transformation generates a toString()
 * method based on the members using `xp::stringOf()`.
 *
 * @see   xp://util.Objects
 * @test  xp://lang.partial.unittest.ToStringTest
 */
class ToString extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return string
   */
  protected function body($mirror) {
    $stringOf= '';
    foreach ($this->instanceFields($mirror) as $i => $field) {
      $n= $field->name();
      $stringOf.= '."  '.$n.' => ".\xp::stringOf($this->'.$n.', "  ")."\n"';
    }

    if ('' === $stringOf) {
      return 'public function toString() { return nameof($this)."@(#".$this->hashCode().")"; }';
    } else if (0 === $i) {
      return 'public function toString() { return nameof($this)."@(".\xp::stringOf($this->'.$n.').")"; }';
    } else {
      return 'public function toString() { return nameof($this)."@[\n"'.$stringOf.'."]"; }';
    }
  }
}