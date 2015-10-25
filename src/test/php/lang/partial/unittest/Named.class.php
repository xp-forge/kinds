<?php namespace lang\partial\unittest;

use lang\partial\Box;

/**
 * Used as fixture in the "BoxTest" and "CompareToTest" classes
 */
class Named extends \lang\Object implements \lang\Value {
  use Named\is\Box { value as name; }

  /** @return bool */
  public function isEmpty() { return '' === $this->value; }
}