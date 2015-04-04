<?php namespace lang\kind\unittest;

use unittest\PrerequisitesNotMetError;

class UsageTest extends \unittest\TestCase {

  #[@test]
  public function create_author() {
    $this->assertEquals(
      new Author('Test'),
      Author::with()->name('Test')->create()
    );
  }

  #[@test]
  public function create_isbn() {
    $this->assertEquals(
      new Isbn('978-3-16-148410-0', Isbn::EAN13),
      Isbn::with()->number('978-3-16-148410-0')->type(Isbn::EAN13)->create()
    );
  }

  #[@test]
  public function create_isbn_with_default_type() {
    $this->assertEquals(
      new Isbn('978-3-16-148410-0', Isbn::EAN13),
      Isbn::with()->number('978-3-16-148410-0')->create()
    );
  }

  #[@test]
  public function create_book() {
    $this->assertEquals(
      new Book('Example', new Author('Test'), new Isbn('978-3-16-148410-0')),
      Book::with()
        ->name('Example')
        ->author(new Author('Test'))
        ->isbn(new Isbn('978-3-16-148410-0'))
        ->create()
    );
  }

  #[@test]
  public function create_book_without_isbn() {
    $this->assertEquals(
      new Book('Example', new Author('Test')),
      Book::with()
        ->name('Example')
        ->author(new Author('Test'))
        ->create()
    );
  }
}