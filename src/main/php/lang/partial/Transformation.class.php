<?php namespace lang\partial;

use lang\mirrors\Member;
use lang\Type;
use lang\XPClass;

/**
 * Compile-time transformation.
 */
abstract class Transformation extends \lang\Object {

  /**
   * Creates trait body. Overwrite in subclasses!
   *
   * @param  lang.mirrors.TypeMirror
   * @return string
   */
  protected abstract function body($mirror);

  /**
   * Type declaration for use in code
   *
   * @param  lang.Type $type
   * @return string
   */
  private function declarationOf($type) {
    if ($type instanceof XPClass) {
      return $type->literal();
    } else if (Type::$CALLABLE->equals($type)) {
      return 'callable';
    } else if (Type::$ARRAY->equals($type)) {
      return 'array';
    } else {
      return '';
    }
  }

  /**
   * Declares a method
   *
   * @param  string $method
   * @param  [:lang.Type] $params
   * @param  lang.Type $return
   * @param  string $body
   * @return string
   */
  protected function newMethod($method, $params, $return, $body) {
    $signature= '';
    $details= "\n";

    foreach ($params as $name => $type) {
      $signature.= ', '.$this->declarationOf($type).' $'.$name;
      $details.= ' * @param '.$type->getName().' $'.$name."\n";
    }

    $details.= ' * @return '.$return->getName()."\n";
    return '/**'.$details.'*/ public function '.$method.'('.substr($signature, 2).') { '.$body.' }';
  }

  /**
   * Returns Field instances for all non-static fields of the given class
   * and the traits it uses.
   *
   * @param  lang.mirrors.TypeMirror $mirror
   * @return php.Generator
   */
  protected function instanceFields($mirror) {
    $seen= [];
    foreach ($mirror->fields()->of(Member::$INSTANCE | Member::$DECLARED) as $field) {
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