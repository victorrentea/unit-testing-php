<?php

namespace PhpUnitWorkshopTest\design\purity;

class PriceService
{
    public function __construct(
        private readonly CustomerRepo     $customerRepo,
        private readonly ThirdPartyPrices $thirdPartyPrices,
        private readonly CouponRepo       $couponRepo,
        private readonly ProductRepo      $productRepo
    )
    {
    }

    /**
     * @param int $customerId
     * @param int[] $productIds
     * @param array<int, float> $internalPrices
     * @return array<int, float>
     */
    function computePrices(int $customerId, array $productIds, array $internalPrices): array
    {
        $customer = $this->customerRepo->findById($customerId);
        $products = $this->productRepo->findAllById($productIds);
        $usedCouponIds = [];
        $finalPrices = [];
        foreach ($products as $product) {
            if (isset($internalPrices[$product->id])) {
                $price = $internalPrices[$product->id];
            }else {
                $price = $this->thirdPartyPrices->retrievePrice($product->id);
            }
            foreach ($customer->coupons as $coupon) {
                if ($coupon->autoApply && $coupon->isApplicableFor($product) && !in_array($coupon->id, $usedCouponIds)) {
                    $price = $coupon->apply($product, $price);
                    $usedCouponIds []= $coupon->id;
                }
            }
            $finalPrices[$product->id] = $price;
        }
        $this->couponRepo->markUsedCoupons($customerId, $usedCouponIds);
        return $finalPrices;
    }

}