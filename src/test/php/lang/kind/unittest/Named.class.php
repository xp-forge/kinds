<?php namespace lang\kind\unittest;

/**
 * Used as fixture in the "IdentityTest" class
 */
class Named extends \lang\Object {
  use \lang\kind\Identity { value as name; }
}