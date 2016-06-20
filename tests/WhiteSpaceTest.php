<?php declare(strict_types = 1);


use ThibaudDauce\CompliantRegexps\Conciliators\Conciliator;
use ThibaudDauce\CompliantRegexps\Conciliators\WhiteSpace;

class WhiteSpaceTest extends ConciliatorTest
{
    protected function getConciliator(): Conciliator
    {
        return new WhiteSpace;
    }

    public function data(): array
    {
        return [
            'One not required space in the variable part' => [
                'regexp' => '/^Flat [ABCDEFGHIJ](-?)\d{3}$/',
                'input' => 'Flat J 114',
                'output' => ['Flat J114', 'FlatJ 114'],
            ],
        ];
    }
}