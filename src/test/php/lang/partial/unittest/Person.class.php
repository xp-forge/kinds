<?php namespace lang\partial\unittest;

use lang\partial\Accessors;
use lang\partial\ToString;
use lang\partial\HashCode;
use lang\partial\Constructor;
use lang\partial\CompareTo;
use lang\partial\Comparators;

/**
 * Used by CompareToTest
 */
class Person implements \lang\Value {
  use Person\including\Accessors;
  use Person\including\ToString;
  use Person\including\HashCode;
  use Person\including\Constructor;
  use Person\including\CompareTo;
  use Person\including\Comparators {
    byBorn as byBirthDate;
  }

  private $firstName, $lastName, $born;
}