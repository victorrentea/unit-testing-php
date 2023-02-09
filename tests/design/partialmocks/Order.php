<?php

namespace PhpUnitWorkshopTest\design\partialmocks;

class Order
{
    private PaymentMethod $paymentMethod;
    private ?int $creationDate;

    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(PaymentMethod $paymentMethod): Order
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getCreationDate(): ?int
    {
        return $this->creationDate;
    }

    public function setCreationDate(int $creationDate): Order
    {
        $this->creationDate = $creationDate;
        return $this;
    }


}