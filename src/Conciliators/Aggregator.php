<?php declare(strict_types = 1);

namespace ThibaudDauce\CompliantRegexps\Conciliators;

class Aggregator implements Conciliator
{
    /**
     * @var Conciliator[]
     */
    private $conciliators;

    public function __construct(array $conciliators)
    {
        $this->conciliators = $conciliators;
    }

    /**
     * Try to transform the string to match the regular expression.
     * Return all the possibilities for conciliating.
     *
     * @param string $regexp
     * @param string $string
     * @return string[]
     */
    public function conciliate(string $regexp, string $string): array
    {
        return $this->aggregate($regexp, [$string], $this->conciliators);
    }

    /**
     * @param string $regexp
     * @param string[] $possibilities
     * @param Conciliator[] $conciliators
     * @return string[]
     */
    private function aggregate(string $regexp, array $possibilities, array $conciliators)
    {
        $newResults = [$possibilities];
        $newConciliators = $conciliators;
        if (empty($conciliators)) {
            return $possibilities;
        }

        foreach ($conciliators as $key => $conciliator) {
            $newPossibilities = $possibilities;
            unset($newConciliators[$key]);
            foreach ($possibilities as $possibility) {
                foreach ($conciliator->conciliate($regexp, $possibility) as $newPossibilitiesFromConciliator) {
                    $newPossibilities[] = $newPossibilitiesFromConciliator;
                }
            }
            $newResults[] = $this->aggregate($regexp, array_unique($newPossibilities), $newConciliators);
            $newConciliators[$key] = $conciliator;
        }

        return array_values(array_unique(call_user_func_array('array_merge', $newResults)));
    }
}