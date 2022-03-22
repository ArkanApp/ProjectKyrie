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

abstract class SubscriptionType {
    const MONTHLY = 0;
    const YEARLY = 1;
    const MONTHLY_STUDENTS = 2;
    const BIANNUAL_STUDENTS = 3;
    const TRIAL = 4;
    const FREE_MONTH = 5;
    const FOREVER = 6;

    /**
     * Subscription types available to purchase.
     *
     * @var array
     */
    private static $types = [
        self::MONTHLY => "monthly",
        self::YEARLY => "yearly",
        self::MONTHLY_STUDENTS => "monthly_students",
        self::BIANNUAL_STUDENTS => "biannual_students",
        self::FOREVER => "forever",
    ];

    /**
     * Subscription types data.
     *
     * @var array
     */
    public static $typesData = [
        self::MONTHLY => [
            "duration" => "1 mes",
            "months" => 1,
            "price" => 129,
            "isActive" => true,
            "isForStudents" => false
        ],
        self::YEARLY => [
            "duration" => "1 año",
            "months" => 12,
            "price" => 1299,
            "isActive" => true,
            "isForStudents" => false
        ],
        self::MONTHLY_STUDENTS => [
            "duration" => "1 mes para estudiantes",
            "months" => 1,
            "price" => 59,
            "isActive" => true,
            "isForStudents" => true
        ],
        self::BIANNUAL_STUDENTS => [
            "duration" => "6 meses para estudiantes",
            "months" => 6,
            "price" => 299,
            "isActive" => true,
            "isForStudents" => true
        ],
        self::TRIAL => [
            "duration" => "Prueba de 15 días",
            "months" => 0.5,
            "price" => 0,
            "isActive" => false,
            "isForStudents" => false
        ],
        self::FREE_MONTH => [
            "duration" => "1 mes - Especial",
            "months" => 1,
            "price" => 0,
            "isActive" => false,
            "isForStudents" => false
        ],
        self::FOREVER => [
            "duration" => "Para siempre",
            "months" => 30 * 12,
            "price" => 0,
            "isActive" => false,
            "isForStudents" => false
        ]
    ];

    /**
     * Returns the subscription type text translation.
     *
     * @param integer $typeId
     * @return string
     */
    public static function getText(int $typeId) {
        return __("subscription_type." . self::$types[$typeId]);
    }
}
