<?php namespace lang\partial\unittest;

use lang\partial\Identity;
use lang\partial\Sortable;

/**
 * Used as fixture in the "IdentityTest" and "SortableTest" classes
 */
class Named extends \lang\Object {
  use Named\is\Identity { value as name; }
  use Named\including\Sortable;

  /** @return bool */
  public function isEmpty() { return '' === $this->value; }
}