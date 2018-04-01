Partials ChangeLog
==================

## ?.?.? / ????-??-??

## 3.1.0 / 2018-03-31

* Made `Box::$value`, `ListOf::$backing` and `ListIndexedBy::$indexed`
  members accessible from subclasses by declaring them protected
  (@thekid)
* Ensured PHP 7.2 compatibility - @thekid

## 3.0.1 / 2017-06-04

* Fixed `lang.partial.ListOf` to also declare `hashCode()` so that
  classes using this trait will be able to implement `lang.Value` 
  (@thekid)

## 3.0.0 / 2017-06-04

* Added forward compatibility with XP 9.0.0 - @thekid

## 2.1.1 / 2017-02-07

* Fixed issue #14: Weird fatals - @thekid

## 2.1.0 / 2016-08-28

* Added forward compatibility with XP 8.0.0 - @thekid

## 2.0.0 / 2016-07-24

* **Heads up: Dropped PHP 5.5 support!** Minimum PHP version required
  is now PHP 5.6. See PR #17
  (@thekid)

## 1.1.2 / 2016-07-24

* Made compatible with `xp-forge/mirrors` 4.0-SERIES - @thekid

## 1.1.1 / 2016-06-29

* Fixed errors when using instance creation with keywords in PHP 5.x
  (@thekid)

## 1.1.0 / 2016-06-24

* Fixed issue #15: Respect keywords. This issue occurs before PHP 7.0
  where keywords may not be used in method declarations (but work OK as
  fields and in method calls) by adding a workaround via `__call()`.
  This was addressed in https://wiki.php.net/rfc/context_sensitive_lexer
  (@thekid)

## 1.0.0 / 2016-02-21

* Added version compatibility with XP 7 - @thekid

## 0.8.0 / 2016-01-23

* Fix code to use `nameof()` instead of the deprecated `getClassName()`
  method from lang.Generic. See xp-framework/core#120
  (@thekid)

## 0.7.0 / 2015-10-25

* Merged PR #13: Add types to generated members - @thekid

## 0.6.0 / 2015-10-25

* Changed `ListIndexedBy` iterator to also return keys - @thekid
* Merged PR #7: Backport to PHP 5.5 - @thekid
* Merged PR #12: Refactor naming:
  - lang.partial.Identity -> lang.partial.Box ("is")
  - lang.partial.ValueObject -> lang.partial.Value ("is")
  - lang.partial.Sortable -> lang.partial.CompareTo ("with")
  - lang.partial.WithCreation -> lang.partial.Builder ("with")
  (@thekid)
* Merged PR #11: Handle transformations and regular traits consistently.
  You can now use `is` and `with` words to reference both transformations
  as well as regular traits without the need to know which one is what
  internally. The *including* term can still be used but is deprecated.
  (@thekid)

## 0.5.0 / 2015-09-27

* Merged PR #9: Constructor transformation - @thekid

## 0.4.0 / 2015-05-16

* **Heads up**: Renamed library to `xp-forge/partial` and changed namespace
  from `lang.kind` to `lang.partial`. See discussion in issue #2
  (@thekid)
* Merged PR #5: Rewrite code to use new `use [Type]\including\[Transformation]`
  form. Has the advantage that we don't need the guillement anymore.
  (@thekid)

## 0.3.0 / 2015-04-20

* Merged PR #1: Use mirrors instead of builtin reflection. This way, we get
  around the limitation that classes cannot be reflected in HHVM while they're
  being loaded - a core premise for our compile-time metaprogramming.
  (@thekid)

## 0.2.0 / 2015-04-06

* Added `lang.kind.Comparator` parametrized trait. It creates `by[Member]`
  methods for each member which return (combineable) comparators.
  (@thekid)
* Added `lang.kind.Sortable` parametrized trait. It creates a compareTo()
  method for sorting instances of classes using this trait.
  (@thekid)
* Changed `lang.kind.WithCreation` trait to parametrized.
  (@thekid)
* Changed `lang.kind.ValueObject` trait to parametrized. Now classes
  using this trait don't need to declare member getters any more.
  (@thekid)
* Added compile-time metaprogramming via *parametrized* traits using
  the syntax `name\of\Trait‹name\of\containing\Class›`. The symbol we use
  is the double closing [guillemet](http://en.wikipedia.org/wiki/Guillemet).
  (@thekid)

## 0.1.0 / 2015-04-04

* Hello World! First release - @thekid