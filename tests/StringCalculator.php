<?php


namespace PhpUnitWorkshopTest;


class StringCalculator
{
    public function Add(string $string): int
    {
        $string = $this->applyCustomDelimiter($string);
        $arr = $this->splitByDelimiters($string);
        $this->negativeChecks($arr);
        return array_sum($arr);
    }

    private function negativeChecks(array $arr): void
    {
        $negatives = array_filter($arr, function ($n) {
            return $n < 0;
        });
        if ($negatives) {
            throw new \Exception("Ex " . implode(",", $negatives));
        }
    }

    private function applyCustomDelimiter(string $string): string
    {
        if (substr($string, 0, 2) !== "//") {
            return $string;
        }
        $header = explode("\n", $string)[0];
        $delimiter = substr($header, 2);

        return str_replace($delimiter, ",", $string);
    }

    private function splitByDelimiters(string $string): array
    {
        $string = str_replace("\n", ",", $string);
        $arr = explode(",", $string);
        return $arr;
    }
}