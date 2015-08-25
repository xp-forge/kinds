<?php namespace lang\partial;

use lang\mirrors\Member;

/**
 * Compile-time transformation.
 */
abstract class Transformation extends \lang\Object {

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror
   * @return string
   */
  protected abstract function body($mirror);

  /**
   * Returns Field instances for all non-static fields of the given class
   * and the traits it uses.
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return php.Generator
   */
  protected function instanceFields($mirror) {
    $return= [];
    $seen= [];
    foreach ($mirror->fields()->of(Member::$INSTANCE | Member::$DECLARED) as $field) {
      $seen[$field->name()]= true;
      $return[]= $field;
    }
    foreach ($mirror->traits() as $trait) {
      foreach ($trait->fields()->of(Member::$INSTANCE) as $field) {
        if (!isset($seen[$field->name()])) {
          $return[]= $field;
        }
      }
    }
    return $return;
  }

  /**
   * Transforms class
   *
   * @param  lang.mirrors.TypeMirror
   * @return string
   */
  public function transform($mirror) {
    return $this->body($mirror);
  }
}