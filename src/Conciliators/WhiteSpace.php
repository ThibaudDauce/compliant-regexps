<?php declare(strict_types = 1);

namespace ThibaudDauce\CompliantRegexps\Conciliators;

class WhiteSpace implements Conciliator
{
    public function conciliate(string $regexp, string $string): array
    {
        $possibilities = [];

        for ($i = 0; $i < strlen($string); $i++) {
            if ($string[$i] === ' ') {
                $possibilities[] = substr_replace($string, '', $i, 1);
            }
        }

        return $possibilities;
    }
}