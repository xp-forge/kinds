Kinds ChangeLog
===============

## ?.?.? / ????-??-??

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
  the syntax `name\of\Trait‹name\of\containing\Class›`. The symbols we
  use are the single [guillemets](http://en.wikipedia.org/wiki/Guillemet).
  (@thekid)

## 0.1.0 / 2015-04-04

* Hello World! First release - @thekid