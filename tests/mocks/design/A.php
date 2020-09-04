<?php
//
//
//namespace PhpUnitWorkshopTest\mocks\design;
//
//
//class A
//{
//    private B $b;
//
//    public function __construct(B $b)
//    {
//        $this->b = $b;
//    }
//
//    function entryPoint(int $x)
//    {
//        $this->b->inner1($x * $x);
//        $this->b->inner2($x * $x);
//    }
//}
//class B
//{
//    function inner1(int $a)
//    {
//        echo "Logic 1\n";
//    }
//}
//class B2 {
//
//    function inner2(int $a): int
//    {
//        echo "Logic 2\n";
//        return $a + 1;
//    }
//}
