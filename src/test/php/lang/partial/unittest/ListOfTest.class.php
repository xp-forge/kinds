<?php namespace lang\partial\unittest;

use lang\ElementNotFoundException;
use unittest\{Expect, Test, TestCase};

class ListOfTest extends \unittest\TestCase {
  private $wall;

  /** @return void */
  public function setUp() {
    $this->wall= new Wall('Test', 'open', []);
  }

  #[Test]
  public function at() {
    $this->assertEquals($this->wall, (new Walls($this->wall))->at(0));
  }

  #[Test, Expect(ElementNotFoundException::class)]
  public function at_raises_exception_when_empty() {
    (new Walls())->at(0);
  }

  #[Test, Expect(ElementNotFoundException::class)]
  public function at_raises_exception_when_non_existant() {
    (new Walls($this->wall))->at(1);
  }

  #[Test]
  public function first() {
    $this->assertEquals($this->wall, (new Walls($this->wall))->first());
  }

  #[Test, Expect(ElementNotFoundException::class)]
  public function first_raises_exception_when_empty() {
    (new Walls())->first();
  }

  #[Test]
  public function present_if_not_empty() {
    $this->assertTrue((new Walls($this->wall))->present());
  }

  #[Test]
  public function present_when_empty() {
    $this->assertFalse((new Walls())->present());
  }

  #[Test]
  public function size() {
    $this->assertEquals(1, (new Walls($this->wall))->size());
  }

  #[Test]
  public function can_be_iterated() {
    $this->assertEquals(
      [$this->wall],
      iterator_to_array((new Walls($this->wall)))
    );
  }

  #[Test]
  public function is_equal_to_itself() {
    $fixture= new Walls($this->wall);
    $this->assertEquals($fixture, $fixture);
  }

  #[Test]
  public function is_equal_to_list_with_same_elements() {
    $this->assertEquals(new Walls($this->wall), new Walls($this->wall));
  }

  #[Test]
  public function is_not_equal_to_list_of_different_length() {
    $this->assertNotEquals(new Walls(), new Walls($this->wall));
  }

  #[Test]
  public function is_not_equal_to_list_with_different_elements() {
    $this->assertNotEquals(new Walls($this->wall), new Walls(new Wall('Other', 'open', [])));
  }

  #[Test]
  public function backing_can_be_accessed() {
    $walls= new class([$this->wall]) extends Walls {
      public function __construct($backing) {
        $this->backing= $backing;
      }
    };
    $this->assertEquals($this->wall, $walls->first());
  }
}