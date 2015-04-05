<?php namespace lang\kind\transform;

/**
 * Compile-time `Comparators` transformation which generates a `by...()`
 * methods for each method that return a comparator. 
 *
 * @test  xp://lang.kind.unittest.lang.kind.unittest.ComparatorsTest
 */
class Comparators extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.XPClass
   * @return string
   */
  protected function body($class) {
    $unit= 'public function compareUsing($cmp, $field) {
      $local= $this->{$field};
      $other= $cmp->{$field};
      if (method_exists($local, \'compareTo\')) {
        return $local->compareTo($other);
      } else {
        return $local === $other ? 0 : ($local < $other ? -1 : 1);
      }
    }';

    foreach ($this->instanceFields($class) as $field) {
      $n= $field->getName();
      $unit.= 'public static function by'.ucfirst($n).'() {
        return newinstance(\'util.Comparator\', [], \'{
          public function compare($a, $b) { return $a->compareUsing($b, \\\''.$n.'\\\'); }
        }\');
      }';
    }
    return $unit;
  }
}