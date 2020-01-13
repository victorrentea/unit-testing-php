<?php


namespace PhpUnitWorkshopTest;


class TestareaImposibilululuiTest
{

   /** @test */
   public function dummy() {

       ImposibilaUtil::parseDate('');
   }
}

class CodProdCareChiarCheamaImposibilaUtil
{
    public static function func(string $sNiciodataGol)
    {
        $date = ImposibilaUtil::parseDate($sNiciodataGol);
    }
}

class ImposibilaUtil {
    public static function parseDate(string $s) {
        if (isEmpty($s)) {
            return null;
        }
    }
}