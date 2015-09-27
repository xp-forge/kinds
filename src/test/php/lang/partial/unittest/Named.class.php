<?php namespace lang\partial\unittest;

use lang\partial\Identity;
use lang\partial\CompareTo;

/**
 * Used as fixture in the "IdentityTest" and "CompareToTest" classes
 */
class Named extends \lang\Object implements \lang\Value {
  use Named\is\Identity { value as name; }
  use Named\including\CompareTo;

  /** @return bool */
  public function isEmpty() { return '' === $this->value; }
}