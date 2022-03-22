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

abstract class CivilStatus {
    const SINGLE = 0;
    const MARRIED = 1;
    const DIVORCED = 2;
    const WIDOWED = 3;
    const OTHER = 4;

    public static $civilStatusConsts = [
        self::SINGLE, self::MARRIED, self::DIVORCED, 
        self::WIDOWED, self::OTHER
    ];

    public static $civilStatus = [
        self::SINGLE => "single",
        self::MARRIED => "married",
        self::DIVORCED => "divorced",
        self::WIDOWED => "widowed",
        self::OTHER => "other"
    ];

    /**
     * Returns the civil status text translation.
     *
     * @param integer $civilStatusId
     * @return string
     */
    public static function getText(int $civilStatusId) {
        return __("civil_status." . self::$civilStatus[$civilStatusId]);
    }
}
