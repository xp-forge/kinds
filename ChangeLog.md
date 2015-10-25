Kinds ChangeLog
===============

## ?.?.? / ????-??-??

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