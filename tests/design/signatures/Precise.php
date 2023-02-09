<?php

namespace PhpUnitWorkshopTest\design\signatures;

class Precise
{
    static function sendSprintFinishedEmail(Project $project)
    {
        echo "Sending email to " . $project->getPoEmail() . " with subject 'Sprint Finished' and some body";
    }
}
