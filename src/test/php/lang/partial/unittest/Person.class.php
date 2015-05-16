<?php namespace lang\partial\unittest;

use \lang\partial\ValueObject;
use \lang\partial\Sortable;
use \lang\partial\Comparators;

/**
 * Used by SortableTest
 */
class Person extends \lang\Object {
  use Person\including\ValueObject;
  use Person\including\Sortable;
  use Person\including\Comparators {
    byBorn as byBirthDate;
  }

  private $firstName, $lastName, $born;

  /**
   * Creates a new author
   *
   * @param  string $firstName
   * @param  string $lastName
   * @param  int $born
   */
  public function __construct($firstName, $lastName, $born) {
    $this->firstName= $firstName;
    $this->lastName= $lastName;
    $this->born= $born;
  }
}