<?php declare(strict_types = 1);


use ThibaudDauce\CompliantRegexps\Conciliators\BestLevenshtein;
use ThibaudDauce\CompliantRegexps\Conciliators\Conciliator;

class BestLevenshteinTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_only_the_best_result()
    {
        $conciliator = new BestLevenshtein(new ConciliatorMock(['Building Arz — C101', 'Building Arz — C-101']));

        $possibilities = $conciliator->conciliate('', 'Buulding  Arz- C-101');
        $this->assertEquals(['Building Arz — C-101'], $possibilities);
    }

    /** @test */
    public function it_returns_nothing_if_nothing()
    {
        $conciliator = new BestLevenshtein(new ConciliatorMock([]));

        $possibilities = $conciliator->conciliate('', 'Buulding  Arz- C-101');
        $this->assertEquals([], $possibilities);
    }
}

class ConciliatorMock implements Conciliator
{
    /**
     * @var array
     */
    private $possibilities;

    public function __construct(array $possibilities)
    {
        $this->possibilities = $possibilities;
    }

    public function conciliate(string $regexp, string $string): array
    {
        return $this->possibilities;
    }
}