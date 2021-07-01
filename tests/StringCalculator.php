<?php


namespace PhpUnitWorkshopTest;

class StringCalculator
{
    static function add(string $text): int
    {
        if ($text == "") {
            return 0;
        } else {
            $delimiter = ",";
            if (substr($text, 0, 2) == '//') {
                $delimiter = $text[2];
                $text = substr($text, 4);
            }
            $pregString = '/\n|\\' . $delimiter . '/';
            $numList = preg_split($pregString, $text);
            return self::sum($numList);
        }
    }

    private static function sum(array $numbers): int
    {
        $total = 0;
        $negString = "";
        foreach ($numbers as $number) {
            if (self::toInt($number) < 0) {
                if ($negString == "") {
                    $negString = $number;
                } else {
                    $negString .= "," . $number;
                }
            }
            if (self::toInt($number) < 1000) {
                $total += self::toInt($number);
            }
        }

        if ($negString != "") {
            throw new \Exception("Negatives not allowed: " . $negString);
        }

        return $total;
    }

    private static function toInt(string $number): int
    {
        return (int)$number;
    }
}