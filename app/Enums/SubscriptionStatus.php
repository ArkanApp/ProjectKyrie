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

abstract class SubscriptionStatus {
    const PENDING_PAYMENT = 0;
    const ACTIVE = 1;
    const SUSPENDED = 2;
    const CANCELLED = 3;
    const FINISHED = 4;

    private static $status = [
        self::PENDING_PAYMENT => "pending_payment",
        self::ACTIVE => "active",
        self::SUSPENDED => "suspended",
        self::CANCELLED => "cancelled",
        self::FINISHED => "finished"
    ];

    /**
     * Returns the status text translation.
     *
     * @param integer $statusId
     * @return string
     */
    public static function getText(int $statusId) {
        return __("subscription_status." . self::$status[$statusId]);
    }
}
