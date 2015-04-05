<?php namespace lang\kind\transform;

/**
 * Compile-time transformation.
 */
abstract class Transformation extends \lang\Object {

  /**
   * Creates trait body
   *
   * @param  lang.XPClass
   * @return string
   */
  protected abstract function body($class);

  /**
   * Returns Field instances for all non-static fields of the given class
   * and the traits it uses.
   *
   * @param  lang.XPClass
   * @return php.Generator
   */
  protected function instanceFields($class) {
    $seen= [];
    foreach ($class->getFields() as $field) {
      if (!($field->getModifiers() & MODIFIER_STATIC)) {
        $seen[$field->getName()]= true;
        yield $field;
      }
    }
    foreach ($class->getTraits() as $trait) {
      foreach ($trait->getFields() as $field) {
        if (!($field->getModifiers() & MODIFIER_STATIC) && !isset($seen[$field->getName()])) {
          yield $field;
        }
      }
    }
  }

  /**
   * Transforms class
   *
   * @param  lang.XPClass
   * @return string
   */
  public function transform($class) {
    return $this->body($class);
  }
}