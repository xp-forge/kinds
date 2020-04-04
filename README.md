Partials: Compile-time metaprogramming
======================================

[![Build Status on TravisCI](https://secure.travis-ci.org/xp-forge/partial.svg)](http://travis-ci.org/xp-forge/partial)
[![XP Framework Module](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Required PHP 5.6+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-5_6plus.png)](http://php.net/)
[![Supports PHP 7.0+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-7_0plus.png)](http://php.net/)
[![Latest Stable Version](https://poser.pugx.org/xp-forge/partial/version.png)](https://packagist.org/packages/xp-forge/partial)

For situations where more logic than just "compiler-assisted copy&paste" using [PHP's traits](http://php.net/traits) is necessary, this library provides a syntax that expand dynamically based on the containing class at compile time.

Partial flavors
---------------
The partials provided by this library's are divided in two flavors: Kinds and composeables.

* **Kinds** define the general concept of a type. You can say, e.g.: This type ***is*** a list of something, or a reference to something. Or, to use more concrete examples: The `Customers` class is a list of customers (encapsulated by `Customer` instances), and `Name` is a reference to (a string) containing a name.
* **Composeables** can be used alone or in combination to extend a base type or a kind. You can say, e.g. This type comes ***with*** a certain functionality. Again, using a realistic use-case: The `Person` class comes with `toString()`, `compareTo()` and `hashCode()` methods.

Regardless of their flavor, some partials are actually implemented by a regular PHP trait, others are dynamically created at runtime. However, the syntax for both is `use [Containing-Type]\[is-or-with]\[Partial-Name]`.

Walk-through
------------
The `Box` trait creates a value object wrapping around exactly one member. It creates a one-arg constructor, and a `value()` for retrieving the value, and includes appropriate `hashCode()`, `compareTo()` and `toString()` implementations. 

Writing this:
```php
namespace example;

use lang\partial\Box;
use lang\Value;

class Name implements Value {
  use Name\is\Box;

  public function personal() { return '~' === $this->value{0}; }
}
```
...is equivalent to:
```php
namespace example;

use lang\Value;

class Name implements Value {
  protected $value;

  public function __construct($value) { $this->value= $value; }

  public function value() { return $this->value; }

  public function personal() { return '~' === $this->value{0}; }

  public function hashCode() { /* ... */ }

  public function compareTo($value) { /* ... */ }

  public function toString() { /* ... */ }
}
```
The parametrized `Accessors` trait creates accessors for all instance members. 

* * * 

Writing this:
```php
namespace example;

use lang\partial\Accessors;

class Wall {
  use Wall\with\Accessors;

  private $name, $type, $posts;

  public function __construct(
    Name $name,
    Type $type,
    Posts $posts
  ) {
    $this->name= $name;
    $this->type= $type;
    $this->posts= $posts;
  }
}
```
...is equivalent to:
```php
namespace example;

class Wall {
  private $name, $type, $posts;

  public function __construct(
    Name $name,
    Type $type,
    Posts $posts
  ) {
    $this->name= $name;
    $this->type= $type;
    $this->posts= $posts;
  }

  public function name() { return $this->name; }

  public function type() { return $this->type; }

  public function posts() { return $this->posts; }
}
```

If the constructor consists solely of assignments, you can include the `Constructor` trait and remove it. The parameters will be declared in the order the fields are declared: top to bottom, left to right in the source code.

* * * 

Writing this:
```php
namespace example;

use lang\partial\Constructor;

class Author {
  use Author\with\Constructor;

  private $handle, $name;
}
```
...is equivalent to:
```php
namespace example;

class Author {
  private $handle, $name;

  public function __construct($handle, $name) {
    $this->handle= $handle;
    $this->name= $name;
  }
}
```

To combine all these, you can use the `Value` trait, which a) creates a constructor with all members as parameters, b) accessors for reading these, and c) implements the `hashCode()`, `compareTo()` and `toString()` methods.

The `ListOf` trait creates a list of elements which can be accessed by their offset, iterated by `foreach`, and offers `equals()` and `toString()` default implementations.

* * * 

Writing this:
```php
namespace example;

use lang\partial\ListOf;

class Posts implements \lang\Value, \IteratorAggregate {
  use Posts\is\ListOf;
}
```
...is equivalent to:
```php
namespace example;

class Posts implements \lang\Value, \IteratorAggregate {
  private $backing;

  public function __construct(...$elements) {
    $this->backing= $elements;
  }

  public function present() { return !empty($this->backing); }

  public function size() { return sizeof($this->backing); }

  public function at($offset) {
    if (isset($this->backing[$offset])) {
      return $this->backing[$offset];
    }
    throw new ElementNotFoundException(…);
  }

  public function first() {
    if (empty($this->backing)) {
      throw new ElementNotFoundException(…);
    }
    return $this->backing[0];
  }

  public function getIterator() {
    foreach ($this->backing as $element) {
      yield $element;
    }
  }

  public function compareTo($value) { /* ... */ }

  public function toString() { /* ... */ }

  public function hashCode() { /* ... */ }
}
```

The `Builder` trait will add a static `with()` method to your class, generating a fluent interface to create instances. This is especially useful in situation where there are a lot of constructor parameters.

The `Comparators` trait adds static `by[Member]` methods returning util.Comparator instances for each member. These instances can be combined using *then* (`Post::byDate()->then(Post::byAuthor())`) or reversed (`Post::byDate()->reverse()`).

```php
namespace example;

use lang\partial\Accessors;
use lang\partial\Builder;
use lang\partial\Comparators;

class Post {
  use Wall\with\Accessors;
  use Wall\with\Builder;
  use Wall\with\Comparators;

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

use lang\partial\ListIndexedBy;

class Walls implements \IteratorAggregate {
  use Walls\is\ListIndexedBy;

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
