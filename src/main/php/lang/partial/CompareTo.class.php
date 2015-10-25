<?php namespace lang\partial;

/**
 * The compile-time `CompareTo` transformation generates a compareTo method
 * which compares member-wise using `Objects::compare()`
 *
 * @see   xp://util.Objects
 * @see   https://wiki.php.net/rfc/comparable
 * @test  xp://lang.partial.unittest.CompareToTest
 */
class CompareTo extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return string
   */
  protected function body($mirror) {
    $compareTo= '';
    foreach ($this->instanceFields($mirror) as $field) {
      $n= $field->name();
      $compareTo.= 'if (0 !== $r= \util\Objects::compare($this->'.$n.', $cmp->'.$n.')) return $r;';
    }
    return 
      "/**\n * @param var\n * @return int\n*/\n".
      'public function compareTo($cmp) { if ($cmp instanceof self) { '.$compareTo.' return 0; } return 1; }'
    ;
  }
}