<?php namespace lang\partial;

abstract class Aggregate extends Transformation {
  private $transformations;

  /**
   * Constructor. Initializes transformations
   */
  public function __construct() {
    $this->transformations= $this->transformations();
  }

  /** @return lang.partial.Transformation[] */
  protected abstract function transformations();

  /**
   * Creates trait body
   *
   * @param  lang.mirrors.TypeMirror
   * @return string
   */
  protected function body($mirror) {
    $body= '';
    foreach ($this->transformations as $transformation) {
      $body.= $transformation->body($mirror);
    }
    return $body;
  }
}