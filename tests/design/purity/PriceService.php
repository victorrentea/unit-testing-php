<?php

namespace PhpUnitWorkshopTest\design\purity;

use JetBrains\PhpStorm\Pure;

class PriceService
{
    public function __construct(
        private readonly CustomerRepo     $customerRepo,
        private readonly ThirdPartyPrices $thirdPartyPrices,
        private readonly CouponRepo       $couponRepo,
        private readonly ProductRepo      $productRepo/*,
        private readonly PriceCalculator $priceCalculator*/
    )
    {
    }

    /**
     * @param int[] $productIds
     * @param array<int, float> $internalPrices
     * @return array<int, float>
     */
    function computePrices(int $customerId, array $productIds, array $internalPrices): array
    {
        $customer = $this->customerRepo->findById($customerId);
        $products = $this->productRepo->findAllById($productIds);
        $resolvedPrices = $this->resolvePrices($products, $internalPrices);

        list($usedCouponIds, $finalPrices) = $this->computePricesPureInternal($products, $resolvedPrices, $customer);

        $this->couponRepo->markUsedCoupons($customerId, $usedCouponIds);
        return $finalPrices;
    }

    #[Pure]
    public static function computePricesPureInternal(array $products, array $resolvedPrices, Customer $customer): array
    {
        $usedCouponIds = [];
        $finalPrices = [];
        // SCOP: Extrage orice logica complicata in fct pure USOR de testat si inteles.
        // pure function: nu are side effects si da acelasi rezultat.
        // pure function: nu face networking si nu modifica campuri
        foreach ($products as $product) {
            $price = $resolvedPrices[$product->id];
            foreach ($customer->coupons as $coupon) {
                if ($coupon->autoApply && $coupon->isApplicableFor($product) && !in_array($coupon->id, $usedCouponIds)) {
                    $price = $coupon->apply($product, $price);
                    $usedCouponIds [] = $coupon->id;
                }
            }
            $finalPrices[$product->id] = $price;
        }
        return array($usedCouponIds, $finalPrices);
    }

    public function resolvePrices(array $products, array $internalPrices): array
    {
        $resolvedPrices = [];
        foreach ($products as $product) {
            if (isset($internalPrices[$product->id])) {
                $price = $internalPrices[$product->id];
            } else {
                $price = $this->thirdPartyPrices->retrievePrice($product->id);
            }
            $resolvedPrices[$product->id] = $price;
        }
        return $resolvedPrices;
    }

}