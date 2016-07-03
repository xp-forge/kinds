<?php namespace lang\partial;

/**
 * Compile-time `Accessors` transformation which generates public accessors
 * based on fields included in your class definition.
 *
 * @see   https://wiki.php.net/rfc/context_sensitive_lexer
 * @test  xp://lang.partial.unittest.AccessorsTest
 */
class AccessorsV5 extends Transformation {

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return string
   */
  protected function body($mirror) {
    $unit= '';
    $get= '';
    foreach ($this->instanceFields($mirror) as $field) {
      $unit.= '/** @return '.$field->type().' */';

      $name= $field->name();
      if (isset(Keywords::$reserved[$name])) {
        $get.= 'else if (\''.$name.'\' === $name) { return $this->'.$name.'; }';
      } else {
        $unit.= 'public function '.$name.'() { return $this->'.$name.'; }';
      }
    }
    if ($get) {
      $unit.= 'public function __call($name, $args) { '.substr($get, 5). '}';
    }
    return $unit;
  }
}