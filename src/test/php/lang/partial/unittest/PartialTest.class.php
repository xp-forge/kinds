<?php namespace lang\partial\unittest;

use lang\ClassLoader;

abstract class PartialTest extends \unittest\TestCase {

  /**
   * Creates a type from a given type body
   *
   * @param  string $body The string `<T>` is replaced by the unique type name
   * @return lang.XPClass
   */
  protected function declareType($body) {
    $declaration= ['kind' => 'class', 'extends' => ['\\lang\\Object'], 'implements' => [], 'use' => []];
    $unique= 'AccessorsTest_'.$this->name;
    return ClassLoader::defineType($unique, $declaration, strtr($body, ['<T>' => $unique]));
  }

  /**
   * Assertion helper
   *
   * @param  string[] $expected
   * @param  lang.XPClass $type
   * @return void
   * @throws unittest.AssertionFailedError
   */
  protected function assertDeclaresMethods($expected, $type) {
    $this->assertEquals($expected, array_map(function($method) { return $method->toString(); }, $type->getDeclaredMethods()));
  }
}