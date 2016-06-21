<?php declare(strict_types = 1);

namespace ThibaudDauce\CompliantRegexps\Conciliators;

class Uppercase implements Conciliator
{
    public function conciliate(string $regexp, string $string): array
    {
        $possibilities = [$string];

        preg_match('/\[(?P<variable>.*)\]/', $regexp, $matches);
        $inverseVariable = $this->inverseCase($matches['variable']);

        $newRegexp = preg_replace('/\[(?P<variable>.*)\]/', "[$inverseVariable]", $regexp);
        if (preg_match($newRegexp, $string)) {
            $charactersOnly = trim($newRegexp, '/');
            if ($charactersOnly[0] === '^') {
                $charactersOnly = substr($charactersOnly, 1);
            }

            $variablePosition = strpos($charactersOnly, "[$inverseVariable]");
            $possibilities[] = substr_replace($string, $this->inverseCase($string[$variablePosition]), $variablePosition, 1);
        }

        return $possibilities;
    }

    private function inverseCase(string $string): string {
        return strtr(
            $string,
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',
            'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
        );
    }
}