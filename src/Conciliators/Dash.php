<?php declare(strict_types = 1);

namespace ThibaudDauce\CompliantRegexps\Conciliators;

class Dash implements Conciliator
{
    public function conciliate(string $regexp, string $string): array
    {
        $possibilities = [$string];

        for ($i = 0; $i < strlen($string); $i++) {
            if ($string[$i] === '-') {
                // remove
                $possibilities[] = substr_replace($string, '', $i, 1);
                // long dash
                $possibilities[] = substr_replace($string, '—', $i, 1);
                $possibilities[] = substr_replace($string, '–', $i, 1);
                // space
                $possibilities[] = substr_replace($string, ' ', $i, 1);
            }
        }

        return $possibilities;
    }
}