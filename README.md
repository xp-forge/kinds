Kinds
=====

[![Build Status on TravisCI](https://secure.travis-ci.org/xp-forge/kinds.svg)](http://travis-ci.org/xp-forge/kinds)
[![XP Framework Module](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Required PHP 5.6+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-5_6plus.png)](http://php.net/)
[![Required HHVM 3.5+](https://raw.githubusercontent.com/xp-framework/web/master/static/hhvm-3_5plus.png)](http://hhvm.com/)
[![Latest Stable Version](https://poser.pugx.org/xp-forge/kinds/version.png)](https://packagist.org/packages/xp-forge/kinds)

Traits for common-used class kinds.

Example
-------
The `Identity` trait creates a value object wrapping around exactly one member, including appropriate `equals()` and `toString()` implementations. The default method for accessing the underlying value can be aliased when using the trait, e.g. `use \lang\kind\Identity { value as name; }`.

```php
class Name extends \lang\Object {
  use \lang\kind\Identity;

  public function personal() { return '~' === $this->value{0}; }
}
```

The `ValueObject` trait ensures `equals()` and `toString()` are implemented for this value object in a generic way, using the util.Objects class to compare the objects memberwise. 

```php
class Type extends \lang\Enum {
  public static $OPEN, CLOSED;
}

class Wall extends \lang\Object {
  use \lang\kind\ValueObject;
  private $name, $type;

  public function __construct($name, Type $type) {
    $this->name= $name;
    $this->type= $type;
  }

  public function name() { return $this->name; }
  public function type() { return $this->type; }
}
```

The `ListIndexedBy` trait creates a list of elements which can be queried by name, also creating `equals()` and `toString()` in a sensible manner.

```php
class Walls extends \lang\Object implements \IteratorAggregate {
  use \lang\kind\ListIndexedBy;

  protected function index($wall) { return $wall->name()->value(); }
}
```

If you don't need the name-lookup, you can use the `ListOf` trait, which only allows accessing elements via their offset, but is more lightweight.

Putting it all together, we can see the API:

```php
$walls= new Walls(
  new Wall(new Name('one'), Type::$OPEN),
  new Wall(new Name('two'), Type::$CLOSED)
);

$walls->present();        // TRUE, list is not empty
$walls->size();           // 2
$walls->provides('one');  // TRUE, wall named one found
$walls->provides('zero'); // FALSE, no such wall
$walls->first();          // Wall(name => Name("one"), type => OPEN)
$walls->named('two');     // Wall(name => Name("two"), type => CLOSED)
$walls->named('three');   // ***ElementNotFoundException

foreach ($walls as $wall) {
  Console::writeLine('- ', $wall->toString());
}
```