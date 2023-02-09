<?php

namespace PhpUnitWorkshopTest\design\signatures;

class Precise
{
    static function sendSprintFinishedEmail(string $poEmail)
    {
        echo "Sending email to " . $poEmail .
            " with subject 'Sprint Finished' and some body";
    }
}
