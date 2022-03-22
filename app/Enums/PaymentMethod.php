<?php
/**
 * Project Kyrie - An Arkan App service oriented to the health area.
 * Created by:
 *  > Mauricio Cruz Portilla <mauricio.portilla@hotmail.com>
 * 
 * This project was created in the hope that it will be useful for any
 * professionist from this area.
 * 
 * July 21st, 2020
 */

namespace App\Enums;

abstract class PaymentMethod {
    const PAYPAL_OR_CARD = 0;
    const BANK = 1;

    public static $methods = [
        self::PAYPAL_OR_CARD => "paypal_or_card",
        self::BANK => "bank"
    ];

    /**
     * Returns the payment method text translation.
     *
     * @param integer $methodId
     * @return string
     */
    public static function getText(int $methodId) {
        return __("payment_method." . self::$methods[$methodId]);
    }
}
