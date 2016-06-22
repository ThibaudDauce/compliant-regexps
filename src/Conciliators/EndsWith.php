<?php declare(strict_types = 1);

namespace ThibaudDauce\CompliantRegexps\Conciliators;

class EndsWith implements Conciliator
{
    public function conciliate(string $regexp, string $string): array
    {
        $possibilities = [$string];

        if (preg_match('/(?!\w\.\!\s)(?P<ends_with>[\w\séèàçê-–—,;\.]*)\$\/$/', $regexp, $matches)) {
            $endsWith = $matches['ends_with'];
            $variablePartRegexp = substr($regexp, 0, strlen($regexp) - (strlen($endsWith) + strlen('$/'))) . '(?P<wrong_end>.*)/';
            if (preg_match($variablePartRegexp, $string, $newMatch)) {
                $onlyVariablePart = substr($string, 0, strlen($string) - strlen($newMatch['wrong_end']));
                $possibilities[] = $this->fusion($onlyVariablePart, $endsWith);
            }

            $possibilities[] = $this->fusion($string, $endsWith);
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
}