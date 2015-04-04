<?php namespace lang\kind\unittest;

/**
 * Used as fixture in the "IdentityTest" and "SortableTest" classes
 */
class Named extends \lang\Object {
  use \lang\kind\Identity { value as name; }
  use \lang\kind\Sortable‹lang\kind\unittest\Named›;

  /** @return bool */
  public function isEmpty() { return '' === $this->value; }
}