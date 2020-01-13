<?php


namespace PhpUnitWorkshopTest;


class Potter
{
    private const DISCOUNT = [
        2 => 0.95,
        3 => 0.9,
        4 => 0.8,
        5 => 0.75,
    ];

    public static function calculatePrice(array $array)
    {
        $sum = 0;
        while (in_array(count($unique = array_unique($array)), array_keys(self::DISCOUNT))) {
            $sum += count($unique) * 8 * self::DISCOUNT[count($unique)];
            $array = self::removeBookSet($array, $unique);
        }

        $sum += count($array) * 8;

        return $sum;
    }

    /**
     * @param array $array
     * @param array $unique
     * @return array
     */
    public static function removeBookSet(array $array, array $unique): array
    {
        $rez = [];
        foreach ($array as $key => $book) {
//               foreach ($unique as => $uniqueKey = )
            if (in_array($book, $unique)) {
                $unique = array_diff($unique, [$book]);
            } else {
                $rez[] = $book;
            }
        }
        return $rez;
    }
}