<?php namespace lang\partial;

/**
 * Compile-time `Sortable` transformation which generates a `compareTo()`
 * method.
 * 
 * ```php
 * use lang\partial\Sortable;
 *
 * class Example extends \lang\Object {
 *   use Example\including\Sortable;
 *
 *   private $firstName, $lastName;
 *
 *   public function __construct($firstName, $lastName) {
 *     $this->firstName= $firstName;
 *     $this->lastName= $lastName;
 *   }
 * }
 * ```
 *
 * @see   https://wiki.php.net/rfc/comparable
 * @test  xp://lang.partial.unittest.SortableTest
 */
class Sortable extends Transformation {

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
      $compareTo.= 'if (method_exists($this->'.$n.', \'compareTo\')) {
        $r= $this->'.$n.'->compareTo($cmp->'.$n.');
      } else {
        $r= ($this->'.$n.' === $cmp->'.$n.') ? 0 : ($this->'.$n.' < $cmp->'.$n.' ? -1 : 1);
      }
      if (0 !== $r) return $r;';
    }
    return
      "/**\n * @param var \$cmp\n * @return int\n*/".
      'public function compareTo($cmp) { if ($cmp instanceof self) { '.$compareTo.'} return 0; }'
    ;
  }
}