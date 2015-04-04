<?php namespace lang\kind;

use lang\XPClass;

trait WithCreation {

  /** @return util.data.InstanceCreation */
  public static function with() {
    return InstanceCreation::of(new XPClass(get_called_class()));
  }
}