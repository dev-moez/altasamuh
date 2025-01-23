<?php

namespace App\Enums;

enum PaymentMethodEnum: int
{
    case VISA_MASTER_CARD = 2;
    case KNET = 1;
    case APPLE_PAY = 11;
}
