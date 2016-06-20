<?php declare(strict_types = 1);

use ThibaudDauce\CompliantRegexps\Conciliators\ValidOnly;
use ThibaudDauce\CompliantRegexps\Conciliators\WhiteSpace;

class ValidOnlyTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_nothing_if_nothing_match()
    {
        $conciliator = new ValidOnly(new WhiteSpace);
        $possibilities = $conciliator->conciliate('/^Flat J114$/', 'Very different');

        $this->assertEmpty($possibilities);
    }

    /** @test */
    public function it_returns_the_only_element_matching()
    {
        $conciliator = new ValidOnly(new WhiteSpace);
        $possibilities = $conciliator->conciliate('/^Flat J114$/', 'Flat J 114');

        $this->assertEquals(['Flat J114'], $possibilities);
    }

    /** @test */
    public function it_returns_multiple_matching_elements()
    {
        $conciliator = new ValidOnly(new WhiteSpace);
        $possibilities = $conciliator->conciliate('/^Flat( ?)J( ?)114$/', 'Flat J 114');

        $this->assertEquals(['FlatJ 114', 'Flat J114'], $possibilities);
    }
}