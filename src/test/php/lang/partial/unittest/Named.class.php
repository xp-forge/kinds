<?php namespace lang\partial\unittest;

use lang\partial\ReferenceTo;
use lang\partial\CompareTo;

/**
 * Used as fixture in the "ReferenceToTest" and "CompareToTest" classes
 */
class Named extends \lang\Object implements \lang\Value {
  use Named\is\ReferenceTo { value as name; }
  use Named\including\CompareTo;

  /** @return bool */
  public function isEmpty() { return '' === $this->value; }
}