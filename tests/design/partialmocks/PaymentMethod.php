<?php

namespace PhpUnitWorkshopTest\design\partialmocks;

enum PaymentMethod
{
    case CARD_ON_PURCHASE;
    case CARD_ON_DELIVERY;
    case CASH_ON_DELIVERY;
}