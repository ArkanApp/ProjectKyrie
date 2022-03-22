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

abstract class Nationality {
    const ARGENTINIAN = 0;
    const AMERICAN = 1;
    const CANADIAN = 2;
    const COLOMBIAN = 3;
    const FRENCH = 4;
    const ITALIAN = 5;
    const MEXICAN = 6;
    const PERUVIAN = 7;
    const SPANISH = 8;
    const OTHER = 100;

    public static $nationalityConsts = [
        self::ARGENTINIAN,
        self::AMERICAN,
        self::CANADIAN,
        self::COLOMBIAN,
        self::FRENCH,
        self::ITALIAN,
        self::MEXICAN,
        self::PERUVIAN,
        self::SPANISH,
        self::OTHER
    ];

    public static $nationalities = [
        self::ARGENTINIAN => "argentinian",
        self::AMERICAN => "american",
        self::CANADIAN => "canadian",
        self::COLOMBIAN => "colombian",
        self::FRENCH => "french",
        self::ITALIAN => "italian",
        self::MEXICAN => "mexican",
        self::PERUVIAN => "peruvian",
        self::SPANISH => "spanish",
        self::OTHER => "other"
    ];

    /**
     * Returns the nationality text translation.
     *
     * @param integer $nationalityId
     * @return string
     */
    public static function getText(int $nationalityId) {
        return __("nationality." . self::$nationalities[$nationalityId]);
    }
}
