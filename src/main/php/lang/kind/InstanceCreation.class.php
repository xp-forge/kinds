<?php namespace lang\kind;

use lang\XPClass;
use lang\ClassLoader;
use lang\IllegalArgumentException;
use lang\reflect\Modifiers;

abstract class InstanceCreation extends \lang\Object {
  private static $creations= [];

  /**
   * Creates a new instance creation fluent interface for a given class
   *
   * @param  var $class Either a lang.XPClass or a string
   * @return lang.XPClass
   */
  public static final function typeOf($class) {
    $type= $class instanceof XPClass ? $class : XPClass::forName($class);
    $key= $type->literal();

    if (!isset(self::$creations[$key])) {
      $setters= $args= '';

      if ($type->isInterface() || $type->isEnum() || Modifiers::isAbstract($type->getModifiers())) {
        throw new IllegalArgumentException('Class '.$type->getName().' is not instantiable');
      } else if (!$type->hasConstructor()) {
        throw new IllegalArgumentException('Class '.$type->getName().' does not have a constructor');
      }

      foreach ($type->getConstructor()->getParameters() as $parameter) {
        $name= $parameter->getName();
        if ($parameter->isOptional()) {
          $setters.= 'public $'.$name.'= '.var_export($parameter->getDefaultValue(), true).';';
        } else {
          $setters.= 'public $'.$name.';';
        }
        $setters.= 'public function '.$name.'($value) { $this->'.$name.'= $value; return $this; }';
        $args.= ', $this->'.$name;
      }

      self::$creations[$key]= ClassLoader::defineClass($type->getName().'Creation', 'lang.kind.InstanceCreation', [], '{
        public function create() { return new \\'.$type->literal().'('.substr($args, 2).'); }
        '.$setters.'
      }');
    }
    return self::$creations[$key];
  }

  /**
   * Creates a new instance creation fluent interface for a given class
   *
   * @param  var $class Either a lang.XPClass or a string
   * @return self
   */
  public static final function of($class) {
    return self::typeOf($class)->newInstance();
  }

  /**
   * Creates the instance
   *
   * @return lang.Generic
   */
  public abstract function create();

  /** @return string */
  public function toString() {
    return $this->getClassName().'('.implode(', ', array_keys(get_object_vars($this))).')';
  }

  /**
   * Returns whether a given value equals this instance
   *
   * @param  var $value
   * @return bool
   */
  public function equals($value) {
    return $value instanceof self && $this->getClassName() === $value->getClassName();
  }
}