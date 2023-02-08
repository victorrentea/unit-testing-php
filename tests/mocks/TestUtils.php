<?php

namespace PhpUnitWorkshopTest\mocks;

use Emag\Core\JiraApiBundle\Tests\Unit\TestCase;
use PHPUnit\Framework\Assert;

class TestUtils
{

    static function assertJustNow(int $time) {
        Assert::assertLessThan(2,abs(time() - $time) );
    }
}