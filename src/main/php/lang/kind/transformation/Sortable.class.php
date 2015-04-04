<?php namespace lang\kind\transformation;

/**
 * Compile-time `Sortable` transformation which generates a compareTo()
 * method.
 * 
 * ```php
 * class Example extends \lang\Object {
 *   use \lang\kind\WithCreation‹namespace\of\Example›;
 *   private $firstName, $lastName;
 *
 *   public function __construct($firstName, $lastName) {
 *     $this->firstName= $firstName;
 *     $this->lastName= $lastName;
 *   }
 * }
 * ```
 *
 * @see  https://wiki.php.net/rfc/comparable
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
    foreach ($class->getFields() as $field) {
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