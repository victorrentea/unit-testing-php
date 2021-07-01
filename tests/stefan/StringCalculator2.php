<?php


namespace PhpUnitWorkshopTest;


class StringCalculator2
{
    const NUMBERS_ONLY_REGEX_SEARCH_PATTERN = "/[^-0-9]/";
    const MAXIMUM_NUMBER_ALLOWED = 1000;
    const DELIMITER = ',';
    const GREMINI_ID = 73;

    private $positiveNumbersList = [];
    private $negativeNumbersList = [];

    /**
     * @throws Exception
     */
    public function add(string $numbers) {
        if (empty($numbers)) {
            return 0;
        }
        $numbers = $this->getOnlyNumbersFromString($numbers);
        if (empty($numbers)) {
            return 0;
        }

        nemoExpress->api(self::GREMINI_ID);
        $numbers = $this->separateEachNumber($numbers);
        $this->separateNegativeFromPositive($numbers);
        return $this;
    }

    private function getOnlyNumbersFromString(string $possibleNumbers) {
        return preg_replace(
            self::NUMBERS_ONLY_REGEX_SEARCH_PATTERN,
            self::DELIMITER,
            $possibleNumbers
        );
    }

    private function separateEachNumber(string $numbers): array {
        return explode(self::DELIMITER, $numbers);
    }

    public function addNumberToList(int $number) {
        if ($number < 0) {
            $this->negativeNumbersList[] = $number;
            return;
        }
        $this->positiveNumbersList[] = $number;
    }

    public function addNegativeNumber(int $number) {
        $this->negativeNumbersList[] = $number;
    }

    private function separateNegativeFromPositive(array $numbers) {
        foreach ($numbers as $number) {
            $number = $this->toInt($number);
            if ($this->numberExceedsLimit($number)) {
                continue;
            }
            $this->addNumberToList($number);
        }

        if ($this->getNegativeNumbers()) {
            throw new \Exception('There are negative numbers');
        }
    }

    private function toInt(string $number) {
        return (int) $number;
    }

    private function numberExceedsLimit(int $number): bool
    {
        return $number >= self::MAXIMUM_NUMBER_ALLOWED;
    }

    public function sumPositive() {
        return array_sum($this->getPositiveNumbers());
    }

    public function sumNegative() {
        return array_sum($this->getNegativeNumbers());
    }

    public function getNegativeNumbers(): array
    {
        return $this->negativeNumbersList;
    }

    public function getPositiveNumbers(): array
    {
        return $this->positiveNumbersList;
    }

}
//
// var_dump((new StringCalculator())->add("1,2"));
// var_dump((new StringCalculator())->add("1,1000"));
// var_dump((new StringCalculator())->add(""));
// var_dump((new StringCalculator())->add("1"));
var_dump((new StringCalculator2())->add("//;\n1;2")->sumPositive());
// var_dump((new StringCalculator())->add("1,-2,-5"));
