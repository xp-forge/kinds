<?php namespace lang\partial;

/**
 * The compile-time `ToString` transformation generates a toString()
 * method based on the members using `util.Objects::stringOf()`.
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
      $stringOf.= '."  '.$n.' => ".\util\Objects::stringOf($this->'.$n.', "  ")."\n"';
    }

    if ('' === $stringOf) {
      $implementation= 'return nameof($this)."@(#".$this->hashCode().")";';
    } else if (0 === $i) {
      $implementation= 'return nameof($this)."@(".\util\Objects::stringOf($this->'.$n.').")";';
    } else {
      $implementation= 'return nameof($this)."@[\n"'.$stringOf.'."]";';
    }
    return '/** @return string */ public function toString() { '.$implementation.' }';
  }
}