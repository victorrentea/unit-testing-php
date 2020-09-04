<?php


namespace PhpUnitWorkshopTest;


class StringCalculator
{
    public function Add(string $string): int
    {
        if (substr($string, 0, 2) === "//") {

            $header = explode("\n", $string)[0];
            $delimiter = substr($header, 2);

            $string = str_replace($delimiter, ",", $string);
        }
        $string = str_replace("\n", ",", $string);
        $arr = explode(",", $string);
        return array_sum($arr);
    }
}