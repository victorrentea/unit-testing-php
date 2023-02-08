<?php

namespace PhpUnitWorkshopTest\design\purity;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use PhpUnitWorkshopTest\design\fixturecreep\Dependency;
use PhpUnitWorkshopTest\design\fixturecreep\FastFood;
use function PHPUnit\Framework\assertEquals;

class PriceServiceTest extends TestCase
{
    private CustomerRepo|MockObject $customerRepo;
    private CouponRepo|MockObject $couponRepo;
    private ProductRepo|MockObject $productRepo;
    private ThirdPartyPrices|MockObject $thirdPartyPrices;

    private PriceService $priceService;

    public function setUp():void
    {
        $this->customerRepo = $this->createMock(CustomerRepo::class);
        $this->couponRepo = $this->createMock(CouponRepo::class);
        $this->productRepo = $this->createMock(ProductRepo::class);
        $this->thirdPartyPrices = $this->createMock(ThirdPartyPrices::class);
        $this->priceService = new PriceService($this->customerRepo, $this->thirdPartyPrices, $this->couponRepo, $this->productRepo);
    }

    function testComputePrices1(): void
    {
        $coupon1 = new Coupon(7, 2, true, ProductCategory::HOME);
        $coupon2 = new Coupon(8, 4, true, ProductCategory::ELECTRONICS);
        $customer = new Customer([$coupon1, $coupon2]);
        $this->customerRepo->method('findById')->with(13)->willReturn($customer);
        $product1 = new Product(1, ProductCategory::HOME);
        $product2 = new Product(2, ProductCategory::KIDS);
        $this->productRepo->method('findAllById')->with([1,2])->willReturn([$product1, $product2]);
        $this->thirdPartyPrices->method('retrievePrice')->with(2)->willReturn(5.0);
        $this->couponRepo->expects(self::exactly(1))->method('markUsedCoupons')->with(13, [7]);

        $result = $this->priceService->computePrices(13, [1,2], [1=>10]);

        assertEquals(8, $result[1]);
        assertEquals(5, $result[2]);
    }

}