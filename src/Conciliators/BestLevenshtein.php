<?php declare(strict_types = 1);

namespace ThibaudDauce\CompliantRegexps\Conciliators;

class BestLevenshtein implements Conciliator
{
    /**
     * @var Conciliator
     */
    private $conciliator;

    public function __construct(Conciliator $conciliator)
    {
        $this->conciliator = $conciliator;
    }

    public function conciliate(string $regexp, string $string): array
    {
        $possibilities = array_map(function(string $possibility) use ($string) {
            return [$possibility, levenshtein($possibility, $string)];
        }, $this->conciliator->conciliate($regexp, $string));

        usort($possibilities, function($possibility1, $possibility2) {
            list(, $similarity1) = $possibility1;
            list(, $similarity2) = $possibility2;

            return $similarity1 - $similarity2;
        });

        list($bestMatch,) = array_shift($possibilities);
        if (is_null($bestMatch)) {
            return [];
        } else {
            return [$bestMatch];
        }
    }
}