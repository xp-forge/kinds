<?php namespace lang\kind;

use lang\IllegalStateException;

trait ListOf {
  private $list;

  public function __construct(...$elements) {
    $this->list= $elements;
  }

  public function getIterator() {
    foreach ($this->list as $element) {
      yield $element;
    }
  }
}