<?php namespace lang\partial\unittest;

use lang\partial\ValueObject;
use lang\partial\WithConstructor;
use lang\partial\Sortable;
use lang\partial\Comparators;

/**
 * Used by SortableTest
 */
class Person extends \lang\Object {
  use Person\including\ValueObject;
  use Person\including\WithConstructor;
  use Person\including\Sortable;
  use Person\including\Comparators {
    byBorn as byBirthDate;
  }

  private $firstName, $lastName, $born;
}