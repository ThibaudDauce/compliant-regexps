<?php declare(strict_types = 1);

use ThibaudDauce\CompliantRegexps\Conciliators\Aggregator;
use ThibaudDauce\CompliantRegexps\Conciliators\StartWith;
use ThibaudDauce\CompliantRegexps\Conciliators\WhiteSpace;

class AggregatorTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_works_with_no_conciliators()
    {
        $conciliator = new Aggregator([]);
        $possibilities = $conciliator->conciliate('/^Flat [ABC]\d{3}$/', 'J114');

        $this->assertEquals(['J114'], $possibilities);
    }

    /** @test */
    public function it_works_with_one_conciliator()
    {
        $conciliator = new Aggregator([new StartWith]);
        $possibilities = $conciliator->conciliate('/^Flat [ABC]\d{3}$/', 'J114');

        $this->assertEquals(['J114', 'Flat J114'], $possibilities);
    }

    /** @test */
    public function it_works_with_two_conciliators()
    {
        $conciliator = new Aggregator([new StartWith, new WhiteSpace]);
        $possibilities = $conciliator->conciliate('/^Flat [ABC]\d{3}$/', 'J 114');

        $this->assertEquals([
            'J 114',
            'Flat J 114',
            'J114',
            'FlatJ 114',
            'Flat J114',
        ], $possibilities);
    }
}