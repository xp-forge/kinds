<?php namespace lang\kind\unittest;

use lang\kind\InstanceCreation;
use lang\XPClass;

class InstanceCreationTest extends \unittest\TestCase {

  #[@test]
  public function of_with_fqcn() {
    $this->assertInstanceOf(
      'lang.kind.InstanceCreation',
      InstanceCreation::of('lang.kind.unittest.Author')
    );
  }

  #[@test]
  public function of_with_class() {
    $this->assertInstanceOf(
      'lang.kind.InstanceCreation',
      InstanceCreation::of(XPClass::forName('lang.kind.unittest.Author'))
    );
  }

  #[@test]
  public function typeOf_with_fqcn() {
    $this->assertInstanceOf(
      'lang.XPClass',
      InstanceCreation::typeOf('lang.kind.unittest.Author')
    );
  }

  #[@test]
  public function typeOf_with_class() {
    $this->assertInstanceOf(
      'lang.XPClass',
      InstanceCreation::typeOf(XPClass::forName('lang.kind.unittest.Author'))
    );
  }

  #[@test]
  public function returned_creationtype_name_in_same_namespace_as_type() {
    $this->assertEquals(
      'lang.kind.unittest.AuthorCreation',
      InstanceCreation::typeOf('lang.kind.unittest.Author')->getName()
    );
  }

  #[@test, @expect('lang.IllegalArgumentException'), @values([
  #  ['interfaces', 'lang.Generic'],
  #  ['enums', 'lang.kind.unittest.Coin'],
  #  ['abstract classes', 'lang.kind.unittest.Entity'],
  #  ['without constructor', 'lang.Object']
  #])]
  public function of_does_not_accept($reason, $class) {
    InstanceCreation::of($class);
  }

  #[@test, @expect('lang.IllegalArgumentException'), @values([
  #  ['interfaces', 'lang.Generic'],
  #  ['enums', 'lang.kind.unittest.Coin'],
  #  ['abstract classes', 'lang.kind.unittest.Entity'],
  #  ['without constructor', 'lang.Object']
  #])]
  public function typeOf_does_not_accept($reason, $class) {
    InstanceCreation::typeOf($class);
  }
}