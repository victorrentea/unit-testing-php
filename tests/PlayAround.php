<?php


namespace PhpUnitWorkshopTest;


$string = "Error +1 stuff";


echo preg_match('/.*-1.*/', $string, $output_array);
echo(new StringCalculator())->Add("-1");