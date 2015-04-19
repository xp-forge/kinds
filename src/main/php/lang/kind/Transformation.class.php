<?php namespace lang\kind;

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
    $seen= [];
    foreach ($mirror->fields()->of(Member::$INSTANCE) as $field) {
      $seen[$field->name()]= true;
      yield $field;
    }
    foreach ($mirror->traits() as $trait) {
      foreach ($trait->fields()->of(Member::$INSTANCE) as $field) {
        if (!isset($seen[$field->name()])) {
          yield $field;
        }
      }
    }
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