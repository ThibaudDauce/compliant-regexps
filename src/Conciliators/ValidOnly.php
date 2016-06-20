<?php declare(strict_types = 1);

namespace ThibaudDauce\CompliantRegexps\Conciliators;

class ValidOnly implements Conciliator
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
        return array_values(array_filter($this->conciliator->conciliate($regexp, $string), function(string $possibility) use ($regexp): bool {
            return preg_match($regexp, $possibility) === 1;
        }));
    }
}