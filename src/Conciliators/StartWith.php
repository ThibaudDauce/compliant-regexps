<?php declare(strict_types = 1);

namespace ThibaudDauce\CompliantRegexps\Conciliators;

class StartWith implements Conciliator
{
    public function conciliate(string $regexp, string $string): array
    {
        preg_match('/^\/\^(?P<start_with>[\w\séèàçê-–—,;]+)(?!\w)/', $regexp, $matches);
        $startWith = $matches['start_with'];

        $newString = $this->fusion($startWith, $string);
        return [$newString];
    }

    private function fusion(string $stringA, string $stringB): string
    {
        $inverseStringA = strrev($stringA);
        $i = 0;
        while ($inverseStringA[$i] === $stringB[$i]) {
            $i++;
        }

        return $stringA . substr($stringB, $i);
    }
}