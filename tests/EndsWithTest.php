<?php declare(strict_types = 1);


use ThibaudDauce\CompliantRegexps\Conciliators\EndsWith;

class EndsWithTest extends ConciliatorTest
{
    protected function getConciliator(): \ThibaudDauce\CompliantRegexps\Conciliators\Conciliator
    {
        return new EndsWith;
    }

    public function data(): array
    {
        return [
            [
                'regexp' => '/^Flat [DEFGHIJ]\d{3} b$/',
                'input' => 'Flat J114 a',
                'output' => ['Flat J114 a', 'Flat J114 a b', 'Flat J114 b'],
            ]
        ];
    }
}