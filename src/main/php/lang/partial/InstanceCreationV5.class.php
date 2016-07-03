<?php namespace lang\partial;

use lang\mirrors\TypeMirror;
use lang\ClassLoader;
use lang\IllegalArgumentException;

abstract class InstanceCreationV5 extends \lang\Object {
  private static $creations= [];

  /**
   * Creates a new instance creation fluent interface for a given class
   *
   * @param  lang.mirrors.TypeMirror|lang.XPClass|string $type
   * @return lang.XPClass
   */
  public static final function typeOf($type) {
    $mirror= $type instanceof TypeMirror ? $type : new TypeMirror($type);
    $type= $mirror->name();

    if (!isset(self::$creations[$type])) {
      if (!$mirror->kind()->isClass() || $mirror->modifiers()->isAbstract()) {
        throw new IllegalArgumentException('Class '.$type.' is not instantiable');
      }

      $constructor= $mirror->constructor();
      if (!$constructor->present()) {
        throw new IllegalArgumentException('Class '.$type.' does not have a constructor');
      }

      $setters= $args= $set= '';
      foreach ($constructor->parameters() as $parameter) {
        $name= $parameter->name();
        if ($parameter->isOptional()) {
          $setters.= 'public $'.$name.'= '.var_export($parameter->defaultValue(), true).';';
        } else {
          $setters.= 'public $'.$name.';';
        }

        if (isset(Keywords::$reserved[$name])) {
          $set.= 'else if (\''.$name.'\' === $name) { $this->'.$name.'= $args[0]; return $this; }';
        } else {
          $setters.= "/**\n * @param ".$parameter->type()."\n * @return self\n*/";
          $setters.= 'public function '.$name.'($value) { $this->'.$name.'= $value; return $this; }';
        }
        $args.= ', $this->'.$name;
      }

      if ($set) {
        $setters.= 'public function __call($name, $args) { '.substr($set, 5). '}';
      }

      self::$creations[$type]= ClassLoader::defineClass($type.'Creation', 'lang.partial.InstanceCreation', [], '{
        /** @return '.$mirror->name().' */
        public function create() { return new \\'.$mirror->reflect->name.'('.substr($args, 2).'); }
        '.$setters.'
      }');
    }
    return self::$creations[$type];
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
    return nameof($this).'('.implode(', ', array_keys(get_object_vars($this))).')';
  }

  /**
   * Returns whether a given value equals this instance
   *
   * @param  var $value
   * @return bool
   */
  public function equals($value) {
    return $value instanceof self && nameof($this) === nameof($value);
  }
}