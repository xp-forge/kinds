<?php namespace lang\kind;

use util\Comparator;

class Comparison extends \lang\Object implements Comparator {
  private $function;

  /**
   * Creates a new comparison based on a given function.
   *
   * @param  function(var, var): int $function
   */
  public function __construct($function) {
    $this->function= $function;
  }

  /**
   * Compares two instances, a and b, using the function passed to the
   * constructor.
   *
   * @param  var $a
   * @param  var $b
   */
  public function compare($a, $b) {
    $f= $this->function;
    return $f($a, $b);
  }

  /**
   * Combines this comparator with another
   *
   * @param  util.Comparator $next
   */
  public function then(Comparator $next) {
    return new self(function($a, $b) use($next) {
      if (0 === ($r= $this->compare($a, $b))) {
        return $next->compare($a, $b);
      } else {
        return $r;
      }
    });
  }
}