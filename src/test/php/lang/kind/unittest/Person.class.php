<?php namespace lang\kind\unittest;

/**
 * Used by SortableTest
 */
class Person extends \lang\Object {
  use \lang\kind\ValueObject‹lang\kind\unittest\Person›;
  use \lang\kind\Sortable‹lang\kind\unittest\Person›;
  use \lang\kind\Comparators‹lang\kind\unittest\Person› {
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