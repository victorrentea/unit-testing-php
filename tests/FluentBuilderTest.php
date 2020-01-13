<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class FluentBuilderTest extends TestCase
{

    /** @test */
    public function dummy()
    {
        $order = (new Order())
            ->setCreationDate(new \DateTime())
            ->setCustomerId(1)
            ->addOrderLine((new OrderLine())
                ->setProductId(15)
//                ->setItemCount(2)
            );
    }
}

class Order
{
    /** @var \DateTime */
    private $creationDate;
    /** @var int */
    private $customerId;
    /** @var OrderLine[] */
    private $orderLines;

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     * @return Order
     */
    public function setCreationDate(\DateTime $creationDate): Order
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     * @return Order
     */
    public function setCustomerId(int $customerId): Order
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * @return OrderLine[]
     */
    public function getOrderLines(): array
    {
        return $this->orderLines;
    }

//    /**
//     * @param OrderLine[] $orderLines
//     * @return Order
//     */
//    public function setOrderLines(array $orderLines): Order
//    {
//        $this->orderLines = $orderLines;
//        return $this;
//    }

    public function addOrderLine(OrderLine $orderLine): Order
    {
        $this->orderLines[] = $orderLine;
        return $this;
    }


}

class OrderLine
{

    /** @var int */
    private $productId;

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return OrderLine
     */
    public function setProductId(int $productId): OrderLine
    {
        $this->productId = $productId;
        return $this;
    }

}