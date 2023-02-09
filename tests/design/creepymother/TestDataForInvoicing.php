<?php

namespace PhpUnitWorkshopTest\design\creepymother;

class TestDataForInvoicing
{
    static function marcel():Customer {
      return new Customer("Marcel",
          "Romania", // daca atingi orice prin clasa asta poti bubui zeci de teste pe care nu le stiai, dupa cativa ani de folosi
          "BillingAddress");
   }
   // NU MODIFICI NIMIC. DOAR ADAUGI. pt ca e pericol.
    // toate testele depind de metodele astea.
}