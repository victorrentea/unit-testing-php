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
        $negatives = array_filter($arr, function ($n) {
            return $n < 0;
        });
        if ($negatives) {
            throw new \Exception("Ex " . implode(",",$negatives));
        }
        return array_sum($arr);
    }
}