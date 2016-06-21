<?php declare(strict_types = 1);

use ThibaudDauce\CompliantRegexps\Conciliators\Conciliator;
use ThibaudDauce\CompliantRegexps\Conciliators\Uppercase;

class UppercaseTest extends ConciliatorTest
{
    protected function getConciliator(): Conciliator
    {
        return new Uppercase;
    }

    public function data(): array
    {
        return [
            [
                'regexp' => '/^Flat [DEFGHIJ]\d{1,3}$/',
                'input' => 'Flat j114',
                'output' => ['Flat j114', 'Flat J114'],
            ]
        ];
    }
}