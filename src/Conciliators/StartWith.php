<?php declare(strict_types = 1);

namespace ThibaudDauce\CompliantRegexps\Conciliators;

class StartWith implements Conciliator
{
    public function conciliate(string $regexp, string $string): array
    {
        $possibilities = [$string];

        if (preg_match('/^\/\^(?P<start_with>[\w\séèàçê-–—,;\.]*)(?!\w)/', $regexp, $matches)) {
            $startWith = $matches['start_with'];
            $possibilities[] = $this->fusion($startWith, $string);

            $variablePartRegexp = $this->getVariablePartRegexp($regexp, $startWith, false);
            if (preg_match($variablePartRegexp, $string, $newMatch)) {
                $onlyVariablePart = substr($string, strlen($newMatch['wrong_start']));
                $possibilities[] = $this->fusion($startWith, $onlyVariablePart);
            }

            $variablePartRegexp = $this->getVariablePartRegexp($regexp, $startWith, true);
            if (preg_match($variablePartRegexp, $string, $newMatch)) {
                $onlyVariablePart = substr($string, strlen($newMatch['wrong_start']));
                $possibilities[] = $this->fusion($startWith, $onlyVariablePart);
            }

            $possibilities[] = $this->fusion($startWith, $string);
        }

        return array_unique($possibilities);
    }

    private function fusion(string $stringA, string $stringB): string
    {
        if (empty($stringA)) {
            return $stringB;
        }
        if (empty($stringB)) {
            return $stringA;
        }

        $inverseStringA = strrev($stringA);
        $i = 0;
        while ($inverseStringA[$i] === $stringB[$i]) {
            $i++;
        }

        return $stringA . substr($stringB, $i);
    }

    private function getVariablePartRegexp($baseRegexp, $nonVariablePart, $lazy = true)
    {
        return '/(?P<wrong_start>.*' . ($lazy ?  '?' : '') . ')' . substr($baseRegexp, strlen($nonVariablePart) + strlen('/^'), -2) . '/';
    }

}