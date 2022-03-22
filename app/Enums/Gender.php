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

abstract class Gender {
    const NOT_KNOWN = 0;
    const MALE = 1;
    const FEMALE = 2;
    const NOT_APPLICABLE = 9;

    public static $genderConsts = [
        self::NOT_KNOWN, self::MALE, self::FEMALE, self::NOT_APPLICABLE
    ];

    public static $genders = [
        self::NOT_KNOWN => "not_known",
        self::MALE => "male",
        self::FEMALE => "female",
        self::NOT_APPLICABLE => "not_applicable"
    ];

    /**
     * Returns the gender text translation.
     *
     * @param integer $genderId
     * @return string
     */
    public static function getText(int $genderId) {
        return __("gender." . self::$genders[$genderId]);
    }
}
