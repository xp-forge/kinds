<?php namespace lang\partial;

/**
 * Compile-time `Comparators` transformation which generates a `by...()`
 * methods for each method that return a comparator. 
 *
 * @test  xp://lang.partial.unittest.ComparatorsTest
 */
class Comparators extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return string
   */
  protected function body($mirror) {
    $unit= 'public function compareUsing($cmp, $field) {
      $local= $this->{$field};
      $other= $cmp->{$field};
      if (method_exists($local, \'compareTo\')) {
        return $local->compareTo($other);
      } else {
        return $local === $other ? 0 : ($local < $other ? -1 : 1);
      }
    }';

    foreach ($this->instanceFields($mirror) as $field) {
      $n= $field->name();
      $unit.= 'public static function by'.ucfirst($n).'() {
        return new \lang\partial\Comparison(function($a, $b) { return $a->compareUsing($b, \''.$n.'\'); });
      }';
    }
    return $unit;
  }
}