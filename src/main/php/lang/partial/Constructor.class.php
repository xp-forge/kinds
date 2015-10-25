<?php namespace lang\partial;

/**
 * Compile-time transformation which generates a constructor.
 * 
 * ```php
 * use lang\partial\Constructor;
 *
 * class Example extends \lang\Object {
 *   use Example\including\Constructor;
 *
 *   private $firstName, $lastName;
 * }
 * ```
 *
 * This generates the following code:
 *
 * ```php
 * public function __construct($firstName, $lastName) {
 *   $this->firstName= $firstName;
 *   $this->lastName= $lastName;
 * }
 * ```
 *
 * The parameters appear in the order the fields are declared: top to bottom,
 * left to right inside the source code.
 *
 * @test  xp://lang.partial.unittest.ConstructorTest
 */
class Constructor extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return string
   */
  protected function body($mirror) {
    $signature= $assignments= $types= '';
    foreach ($this->instanceFields($mirror) as $field) {
      $n= $field->name();
      $types.= ' * @param '.$field->type()."\n";
      $signature.= ', $'.$n;
      $assignments.= '$this->'.$n.'= $'.$n.';';
    }
    return "/**\n".$types."*/\npublic function __construct(".substr($signature, 2).') { '.$assignments.' }';
  }
}