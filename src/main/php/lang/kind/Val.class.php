<?php namespace lang\kind;

use util\Objects;

trait Val {

  /**
   * Returns whether a given value is equal to this value
   *
   * @param  var $cmp
   * @return bool
   */
  public function equals($cmp) {
    if ($cmp instanceof self) {
      $thisVars= (array)$this;
      $cmpVars= (array)$cmp;
      unset($thisVars['__id'], $cmpVars['__id']);
      return Objects::equal($thisVars, $cmpVars);
    }
    return false;
  }

  /**
   * Creates a string representation
   *
   * @return string
   */
  public function toString() {
    $thisVars= get_object_vars($this);
    unset($thisVars['__id']);
    if (1 === sizeof($thisVars)) {
      return $this->getClassName().'('.Objects::stringOf($thisVars[key($thisVars)]).')';
    } else {
      return $this->getClassName().'@'.Objects::stringOf($thisVars);
    }
  }
}