<?php

namespace PhpUnitWorkshopTest\design\creepymother;

class TestData
{
    static function joe():Customer {
      return new Customer("Joe", "Romania", "BillingAddress");
   }
}