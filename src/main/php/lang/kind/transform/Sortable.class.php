<?php namespace lang\kind\transform;

/**
 * Compile-time `Sortable` transformation which generates a `compareTo()`
 * method.
 * 
 * ```php
 * class Example extends \lang\Object {
 *   use \lang\kind\Sortable‹namespace\of\Example›;
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
 * @test  xp://lang.kind.unittest.SortableTest
 */
class Sortable extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.XPClass
   * @return string
   */
  protected function body($class) {
    $compareTo= '';
    $fields= $class->getFields();
    foreach ($class->getTraits() as $trait) {
      $fields= array_merge($fields, $trait->getFields());
    }
    foreach ($fields as $field) {
      if (!($field->getModifiers() & MODIFIER_STATIC)) {
        $n= $field->getName();
        $compareTo.= 'if (method_exists($this->'.$n.', \'compareTo\')) {
          $r= $this->'.$n.'->compareTo($cmp->'.$n.');
        } else {
          $r= ($this->'.$n.' === $cmp->'.$n.') ? 0 : ($this->'.$n.' < $cmp->'.$n.' ? -1 : 1);
        }
        if (0 !== $r) return $r;';
      }
    }
    return 'public function compareTo($cmp) { if ($cmp instanceof self) { '.$compareTo.'} return 0; }';
  }
}