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
      return 'public function hashCode() { return spl_object_hash($this); }';
    } else {
      echo $mirror->toString(), 'public function hashCode() { return md5(nameof($this)'.$hashes.'); }', PHP_EOL;
      return 'public function hashCode() { return md5(nameof($this)'.$hashes.'); }';
    }
  }
}