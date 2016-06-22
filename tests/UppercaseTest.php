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
            'Change case of the variable part' => [
                'regexp' => '/^Flat [DEFGHIJ]\d{1,3}$/',
                'input' => 'Flat j114',
                'output' => ['Flat j114', 'Flat J114'],
            ],
            'Do nothing if there is no variable part' => [
                'regexp' => '/^Flat \d{1,3}$/',
                'input' => 'flat 114',
                'output' => ['flat 114'],
            ],
        ];
    }
}