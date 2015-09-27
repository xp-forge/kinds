<?php namespace lang\partial\unittest;

use lang\partial\Accessors;
use lang\partial\ToString;
use lang\partial\Equals;
use lang\partial\Constructor;
use lang\partial\CompareTo;
use lang\partial\Comparators;

/**
 * Used by CompareToTest
 */
class Person extends \lang\Object {
  use Person\including\Accessors;
  use Person\including\ToString;
  use Person\including\Equals;
  use Person\including\Constructor;
  use Person\including\CompareTo;
  use Person\including\Comparators {
    byBorn as byBirthDate;
  }

  private $firstName, $lastName, $born;
}