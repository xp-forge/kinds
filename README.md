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
The `Identity` trait creates a value object wrapping around exactly one member. It creates a one-arg constructor, and a `value()` for retrieving the value, and includes appropriate `equals()` and `toString()` implementations. 

```php
namespace example;

class Name extends \lang\Object {
  use \lang\kind\Identity;

  public function personal() { return '~' === $this->value{0}; }
}
```

For situations where more logic than just "compiler-assisted copy&paste" is necessary, this library provides traits that expand dynamically based on the containing class at compile time. We use the syntax `name\of\Trait»name\of\containing\Class` for them, which we called *parametrized*. The symbol we use is the double closing [guillemet](http://en.wikipedia.org/wiki/Guillemet).

The parametrized `ValueObject` trait creates accessors for all instance members and ensures `equals()` and `toString()` are implemented for this value object in a generic way, using the util.Objects class to compare the objects memberwise. All we need to do is to add a constructor (*this is not generated as we might want to add default values and custom verification logic*).

```php
namespace example;

class Type extends \lang\Enum {
  public static $OPEN, $CLOSED;
}

class Wall extends \lang\Object {
  use \lang\kind\ValueObject»example\Wall;
  private $name, $type, $posts;

  public function __construct(Name $name, Type $type, Posts $posts) {
    $this->name= $name;
    $this->type= $type;
    $this->posts= $posts;
  }
}
```

The `ListOf` trait creates a list of elements which can be accessed by their offset, iterated by `foreach`, and offers `equals()` and `toString()` default implementations.

```php
namespace example;

class Posts extends \lang\Object implements \IteratorAggregate {
  use \lang\kind\ListOf;
}
```

The `WithCreation` trait will add a static `with()` method to your class, generating a fluent interface to create instances. This is especially useful in situation where there are a lot of constructor parameters.

The `Comparators` trait adds static `by[Member]` methods returning util.Comparator instances for each member. These instances can be combined using *then* (`Post::byDate()->then(Post::byAuthor())`) or reversed (`Post::byDate()->reverse()`).

```php
namespace example;

class Post extends \lang\Object {
  use \lang\kind\ValueObject»example\Post;
  use \lang\kind\WithCreation»example\Post;
  use \lang\kind\Comparators»example\Post;
  private $author, $text, $date;

  public function __construct($author, $text, Date $date) {
    $this->author= $author;
    $this->text= $text;
    $this->date= $date;
  }
}
```

The `ListIndexedBy` trait creates a list of elements which can be queried by name, also overloading iteration and creating `equals()` and `toString()` in a sensible manner. The class needs to implement the abstract `index` method and return a string representing the name.

```php
namespace example;

class Walls extends \lang\Object implements \IteratorAggregate {
  use \lang\kind\ListIndexedBy;

  protected function index($wall) { return $wall->name()->value(); }
}
```

Putting it all together, we can see the API:

```php
use util\data\Sequence;

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
  Console::writeLine('== ', $wall->name()->value(), ' wall (', $wall->type(), ') ==');
  Sequence::of($wall->posts())->sorted(Post::byDate())->each(function($post) {
    Console::writeLine('Written by ', $post->author(), ' on ', $post->date());
    Console::writeLine($post->text());
    Console::writeLine();
  });
}
```

See also
--------
* http://groovy-lang.org/metaprogramming.html
* http://projectlombok.org/