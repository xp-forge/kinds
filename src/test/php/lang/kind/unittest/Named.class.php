<?php namespace lang\kind\unittest;

use lang\kind\Identity;
use lang\kind\Sortable;

/**
 * Used as fixture in the "IdentityTest" and "SortableTest" classes
 */
class Named extends \lang\Object {
  use Identity { value as name; }
  use Named\including\Sortable;

  /** @return bool */
  public function isEmpty() { return '' === $this->value; }
}