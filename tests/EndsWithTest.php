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
            'Ends with " a" instead of " b"' => [
                'regexp' => '/^Flat [DEFGHIJ]\d{3} b$/',
                'input' => 'Flat J114 a',
                'output' => ['Flat J114 a', 'Flat J114 a b', 'Flat J114 b'],
            ],
            'Ends with " 9" instead of nothing' => [
                'regexp' => '/^Flat [DEFGHIJ]\d{3}$/',
                'input' => 'Flat J114 9',
                'output' => ['Flat J114 9', 'Flat J114'],
            ],
            'Ends with nothing' => [
                'regexp' => '/^Flat [DEFGHIJ]\d{1,3}$/',
                'input' => 'Flat madrilles',
                'output' => ['Flat madrilles'],
            ],
//            'Replace even if there is something at the beginning' => [
//                'regexp' => '/^Flat [ABC]\d{1,3}.$/',
//                'input' => 'Building A114 A',
//                'output' => ['Building A114 A', 'Building A114 A.', 'Building A114.'],
//            ],
        ];
    }
}