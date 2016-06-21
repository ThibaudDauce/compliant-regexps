<?php declare(strict_types = 1);


use ThibaudDauce\CompliantRegexps\Conciliators\Dash;

class DashTest extends ConciliatorTest
{
    protected function getConciliator(): \ThibaudDauce\CompliantRegexps\Conciliators\Conciliator
    {
        return new Dash;
    }

    public function data(): array
    {
        return [
            [
                'regexp' => '/^Flat [DEFGHIJ]114$/',
                'input' => 'Flat J-114',
                'output' => ['Flat J-114', 'Flat J114', 'Flat J 114', 'Flat J—114', 'Flat J–114'],
            ]
        ];
    }
}