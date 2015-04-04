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
  private $name, $type, $posts;

  public function __construct(Name $name, Type $type, Posts $posts) {
    $this->name= $name;
    $this->type= $type;
    $this->posts= $posts;
  }

  public function name() { return $this->name; }
  public function type() { return $this->type; }
  public function posts() { return $this->posts; }
}
```

The `ListOf` trait creates a list of elements which can be accessed by their offset, and offers `equals()` and `toString()` default implementations.

```php
class Posts extends \lang\Object implements \IteratorAggregate {
  use \lang\kind\ListOf;
}
```

The `WithCreation` trait will add a static `with()` method to your class, generating a fluent interface to create instances. This is especially useful in situation where there are a lot of constructor parameters.

```php
class Post extends \lang\Object {
  use \lang\kind\ValueObject;
  use \lang\kind\WithCreation;
  private $author, $text, $date;

  public function __construct($author, $text, Date $date) {
    $this->author= $author;
    $this->text= $text;
    $this->date= $date;
  }

  public function author() { return $this->author; }
  public function text() { return $this->text; }
  public function date() { return $this->date; }
}
```

The `ListIndexedBy` trait creates a list of elements which can be queried by name, also creating `equals()` and `toString()` in a sensible manner.

```php
class Walls extends \lang\Object implements \IteratorAggregate {
  use \lang\kind\ListIndexedBy;

  protected function index($wall) { return $wall->name()->value(); }
}
```

Putting it all together, we can see the API:

```php
$post= Post::with()->author('Timm')->text('Hello World!')->date(Date::now())->create();

$walls= new Walls(
  new Wall(new Name('one'), Type::$OPEN, new Posts()),
  new Wall(new Name('two'), Type::$CLOSED, new Posts($post))
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