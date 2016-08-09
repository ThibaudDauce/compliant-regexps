<?php declare(strict_types = 1);


use ThibaudDauce\CompliantRegexps\Conciliators\StartWith;

class StartWithTest extends ConciliatorTest
{
    protected function getConciliator(): \ThibaudDauce\CompliantRegexps\Conciliators\Conciliator
    {
        return new StartWith;
    }

    public function data(): array
    {
        return [
            'Start with « Flat »' => [
                'regexp' => '/^Flat [ABCDEFGHIJ](-?)\d{3}$/',
                'input' => 'J114',
                'output' => ['J114', 'Flat J114'],
            ],
            'Raw like « <space>J114 »' => [
                'regexp' => '/^Flat [ABCDEFGHIJ](-?)\d{3}$/',
                'input' => ' J114',
                'output' => [' J114', 'Flat J114'],
            ],
            'Regexp with an accent' => [
                'regexp' => '/^Résidence Madrillet [ABCDEFGHIJ](-?)\d{3}$/',
                'input' => 'J114',
                'output' => ['J114', 'Résidence Madrillet J114'],
            ],
            'Regexp with a dash' => [
                'regexp' => '/^Madrillet — [ABCDEFGHIJ](-?)\d{3}$/',
                'input' => 'J114',
                'output' => ['J114', 'Madrillet — J114'],
            ],
            'Replace start with' => [
                'regexp' => '/^Flat [ABCDEFGHIJ](-?)\d{3}$/',
                'input' => 'My J114',
                'output' => ['My J114', 'Flat My J114', 'Flat J114'],
            ],
            'Starts with nothing' => [
                'regexp' => '/^[DEFGHIJ]\d{1,3} flat.$/',
                'input' => 'Flat madrilles',
                'output' => ['Flat madrilles'],
            ],
            'Replace even if there is something at the end' => [
                'regexp' => '/^Flat [ABC]\d{1,3}$/',
                'input' => 'Building A114 A',
                'output' => ['Building A114 A', 'Flat A114 A', 'Flat Building A114 A'],
            ],
            'Fusion keeps initial 0' => [
                'regexp' => '/^Flat \d{1,3}$/',
                'input' => '002',
                'output' => ['002', 'Flat 002', 'Flat 2'],
            ],
            'Keep the maximum of digit (lazy wildcard)' => [
                'regexp' => '/^Flat \d{1,3}$/',
                'input' => 'DD002',
                'output' => ['DD002', 'Flat 2', 'Flat DD002', 'Flat 002'],
            ],
        ];
    }
}