<?php
//
//
//namespace PhpUnitWorkshopTest\mocks\design;
//
//
//
//
//use PHPUnit\Framework\TestCase;
//
//class ATest extends TestCase
//{
//    public function testEntryPoint()
//    {
//        $b = $this->mock(B::class);
//        $b = $this->mock(B2::class);
//        $b->method("inner")->with(5)->whenParam(4);
//        $a = new A($b);
//
//        assert 5 === $a ->entryPoint(2);
//    }
//    public function testEntryPoint2()
//    {
//        $a = new A(new B(/*depB*/));
//
//        assert 5 === $a ->entryPoint(2);
//    }
//}
