<?php namespace lang\partial;

/**
 * The compile-time `HashCode` transformation generates an equals method
 * which compares member-wise using `Objects::hashOf()`
 *
 * @see   xp://util.Objects
 * @test  xp://lang.partial.unittest.HashCodeTest
 */
class HashCode extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return string
   */
  protected function body($mirror) {
    $hashes= '';
    foreach ($this->instanceFields($mirror) as $field) {
      $n= $field->name();
      $hashes.= '.\util\Objects::hashOf($this->'.$n.')';
    }

    if ('' === $hashes) {
      $implementation= 'return spl_object_hash($this);';
    } else {
      $implementation= 'return md5(nameof($this)'.$hashes.');';
    }
    return '/** @return string */ public function hashCode() { '.$implementation.' }';
  }
}