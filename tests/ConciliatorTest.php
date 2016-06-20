<?php declare(strict_types = 1);

use ThibaudDauce\CompliantRegexps\Conciliators\Conciliator;

abstract class ConciliatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Conciliator
     */
    private $conciliator;

    public function setUp()
    {
        parent::setUp();
        $this->conciliator = $this->getConciliator();
    }

    /**
     * @test
     * @dataProvider data
     * @param string $regexp
     * @param string $input
     * @param array $output
     */
    public function it_conciliate_the_string_with_the_regexp($regexp, $input, $output)
    {
        $possibilities = $this->conciliator->conciliate($regexp, $input);
        sort($output);
        sort($possibilities);

        $this->assertEquals($possibilities, $output);
    }

    abstract protected function getConciliator(): Conciliator;

    abstract public function data(): array;
}