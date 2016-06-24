<?php namespace lang\partial;

/**
 * Compile-time `Accessors` transformation which generates public accessors
 * based on fields included in your class definition.
 *
 * @see   https://wiki.php.net/rfc/context_sensitive_lexer
 * @test  xp://lang.partial.unittest.AccessorsTest
 */
class AccessorsV5 extends Transformation {
  private static $keywords= [
    'callable'      => true,
    'class'         => true,
    'trait'         => true,
    'extends'       => true,
    'implements'    => true,
    'static'        => true,
    'abstract'      => true,
    'final'         => true,
    'public'        => true,
    'protected'     => true,
    'private'       => true,
    'const'         => true,
    'enddeclare'    => true,
    'endfor'        => true,
    'endforeach'    => true,
    'endif'         => true,
    'endwhile'      => true,
    'and'           => true,
    'global'        => true,
    'goto'          => true,
    'instanceof'    => true,
    'insteadof'     => true,
    'interface'     => true,
    'namespace'     => true,
    'new'           => true,
    'or'            => true,
    'xor'           => true,
    'try'           => true,
    'use'           => true,
    'var'           => true,
    'exit'          => true,
    'list'          => true,
    'clone'         => true,
    'include'       => true,
    'include_once'  => true,
    'throw'         => true,
    'array'         => true,
    'print'         => true,
    'echo'          => true,
    'require'       => true,
    'require_once'  => true,
    'return'        => true,
    'else'          => true,
    'elseif'        => true,
    'default'       => true,
    'break'         => true,
    'continue'      => true,
    'switch'        => true,
    'yield'         => true,
    'function'      => true,
    'if'            => true,
    'endswitch'     => true,
    'finally'       => true,
    'for'           => true,
    'foreach'       => true,
    'declare'       => true,
    'case'          => true,
    'do'            => true,
    'while'         => true,
    'as'            => true,
    'catch'         => true,
    'die'           => true,
    'self'          => true,
    'parent'        => true
  ];

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
      if (isset(self::$keywords[$name])) {
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