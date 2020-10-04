<?php namespace lang\partial\unittest;

use lang\partial\InstanceCreation;
use lang\{IllegalArgumentException, XPClass};
use unittest\{Expect, Test, Values};

class InstanceCreationTest extends \unittest\TestCase {

  #[Test]
  public function of_with_fqcn() {
    $this->assertInstanceOf(
      'lang.partial.InstanceCreation',
      InstanceCreation::of('lang.partial.unittest.Author')
    );
  }

  #[Test]
  public function of_with_class() {
    $this->assertInstanceOf(
      'lang.partial.InstanceCreation',
      InstanceCreation::of(XPClass::forName('lang.partial.unittest.Author'))
    );
  }

  #[Test]
  public function typeOf_with_fqcn() {
    $this->assertInstanceOf(
      'lang.XPClass',
      InstanceCreation::typeOf('lang.partial.unittest.Author')
    );
  }

  #[Test]
  public function typeOf_with_class() {
    $this->assertInstanceOf(
      'lang.XPClass',
      InstanceCreation::typeOf(XPClass::forName('lang.partial.unittest.Author'))
    );
  }

  #[Test]
  public function returned_creationtype_name_in_same_namespace_as_type() {
    $this->assertEquals(
      'lang.partial.unittest.AuthorCreation',
      InstanceCreation::typeOf('lang.partial.unittest.Author')->getName()
    );
  }

  #[Test, Expect(IllegalArgumentException::class), Values([['interfaces', 'lang.Generic'], ['enums', 'lang.partial.unittest.Coin'], ['abstract classes', 'lang.partial.unittest.Entity'], ['without constructor', 'lang.partial.unittest.WithoutConstructor']])]
  public function of_does_not_accept($reason, $class) {
    InstanceCreation::of($class);
  }

  #[Test, Expect(IllegalArgumentException::class), Values([['interfaces', 'lang.Generic'], ['enums', 'lang.partial.unittest.Coin'], ['abstract classes', 'lang.partial.unittest.Entity'], ['without constructor', 'lang.partial.unittest.WithoutConstructor']])]
  public function typeOf_does_not_accept($reason, $class) {
    InstanceCreation::typeOf($class);
  }

  #[Test]
  public function keywords() {
    $instance= InstanceCreation::of(XPClass::forName('lang.partial.unittest.Event'))
      ->name('Test')
      ->class('public')
      ->create()
    ;
    $this->assertEquals('public', $instance->class());
  }
}