<?php declare(strict_types = 1);

namespace ThibaudDauce\CompliantRegexps\Conciliators;

interface Conciliator
{
    /**
     * Try to transform the string to match the regular expression.
     * Return all the possibilities for conciliating.
     *
     * @param string $regexp
     * @param string $string
     * @return string[]
     */
    public function conciliate(string $regexp, string $string): array;
}