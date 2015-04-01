Kinds
=====

[![Build Status on TravisCI](https://secure.travis-ci.org/xp-forge/kinds.svg)](http://travis-ci.org/xp-forge/kinds)
[![XP Framework Module](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Required PHP 5.6+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-5_6plus.png)](http://php.net/)
[![Required HHVM 3.5+](https://raw.githubusercontent.com/xp-framework/web/master/static/hhvm-3_5plus.png)](http://hhvm.com/)
[![Latest Stable Version](https://poser.pugx.org/xp-forge/kinds/version.png)](https://packagist.org/packages/xp-forge/kinds)

Traits for compile-time metaprogramming.

ListIndexedBy
-------------
This trait creates a list of elements which can be queried by name.

```php
class Wall extends \lang\Object {
  private $name;

  public function __construct($name) { $this->name= $name; }
  public function name() { return $this->name; }
}

class Walls extends \lang\Object {
  use \lang\kind\ListIndexedBy;

  protected function index($wall) { return $wall->name(); }
}

$walls= new Walls(new Wall('one'), new Wall('two'));

$walls->present();        // TRUE, list is not empty
$walls->provides('one');  // TRUE, wall named one found
$walls->provides('zero'); // FALSE, no such wall
$walls->named('two');     // Wall("two")
$walls->named('three');   // ***ElementNotFoundException

foreach ($walls as $wall) {
  // TBI
}
```