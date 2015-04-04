<?php namespace lang\kind\unittest;

use lang\ElementNotFoundException;

class ListOfTest extends \unittest\TestCase {

  public function setUp() {
    $this->wall= new Wall('Test', 'open');
  }

  #[@test]
  public function at() {
    $this->assertEquals($this->wall, (new Walls($this->wall))->at(0));
  }

  #[@test, @expect(ElementNotFoundException::class)]
  public function at_raises_exception_when_empty() {
    (new Walls())->at(0);
  }

  #[@test, @expect(ElementNotFoundException::class)]
  public function at_raises_exception_when_non_existant() {
    (new Walls($this->wall))->at(1);
  }

  #[@test]
  public function first() {
    $this->assertEquals($this->wall, (new Walls($this->wall))->first());
  }

  #[@test, @expect(ElementNotFoundException::class)]
  public function first_raises_exception_when_empty() {
    (new Walls())->first();
  }

  #[@test]
  public function present_if_not_empty() {
    $this->assertTrue((new Walls($this->wall))->present());
  }

  #[@test]
  public function present_when_empty() {
    $this->assertFalse((new Walls())->present());
  }

  #[@test]
  public function size() {
    $this->assertEquals(1, (new Walls($this->wall))->size());
  }

  #[@test]
  public function can_be_iterated() {
    $this->assertEquals(
      [$this->wall],
      iterator_to_array((new Walls($this->wall)))
    );
  }

  #[@test]
  public function is_equal_to_itself() {
    $fixture= new Walls($this->wall);
    $this->assertEquals($fixture, $fixture);
  }

  #[@test]
  public function is_equal_to_list_with_same_elements() {
    $this->assertEquals(new Walls($this->wall), new Walls($this->wall));
  }

  #[@test]
  public function is_not_equal_to_list_of_different_length() {
    $this->assertNotEquals(
      new Walls(),
      new Walls($this->wall)
    );
  }

  #[@test]
  public function is_not_equal_to_list_with_different_elements() {
    $this->assertNotEquals(
      new Walls($this->wall),
      new Walls(newinstance('unittest.TestCase', ['test'], ['test' => function() { }])
    ));
  }
}