<?php namespace lang\partial\unittest;

use lang\partial\Box;
use lang\partial\CompareTo;

/**
 * Used as fixture in the "BoxTest" and "CompareToTest" classes
 */
class Named extends \lang\Object implements \lang\Value {
  use Named\is\Box { value as name; }
  use Named\including\CompareTo;

  /** @return bool */
  public function isEmpty() { return '' === $this->value; }
}