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

abstract class Country {
    const ARGENTINA = 0;
    const UNITED_STATES = 1;
    const CANADA = 2;
    const COLOMBIA = 3;
    const FRANCE = 4;
    const ITALIA = 5;
    const MEXICO = 6;
    const PERU = 7;
    const SPAIN = 8;
    const OTHER = 100;

    public static $countryConsts = [
        self::ARGENTINA,
        self::UNITED_STATES,
        self::CANADA,
        self::COLOMBIA,
        self::FRANCE,
        self::ITALIA,
        self::MEXICO,
        self::PERU,
        self::SPAIN,
        self::OTHER
    ];

    public static $countries = [
        self::ARGENTINA => "argentina",
        self::UNITED_STATES => "united_states",
        self::CANADA => "canada",
        self::COLOMBIA => "colombia",
        self::FRANCE => "france",
        self::ITALIA => "italia",
        self::MEXICO => "mexico",
        self::PERU => "peru",
        self::SPAIN => "spain",
        self::OTHER => "other"
    ];

    /**
     * Returns the country text translation.
     *
     * @param integer $countryId
     * @return string
     */
    public static function getText(int $countryId) {
        return __("country." . self::$countries[$countryId]);
    }
}
