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

abstract class ToothFaceDisease {
    const ABFRACTION = 0;
    const ABRASION = 1;
    const ATTRITION = 2;
    const VENEER_GOOD_STATE = 3;
    const VENEER_BAD_STATE = 4;
    const HEALING = 5;
    const PACKAGING = 6;
    const EROSION = 7;
    const CARIOUS_INJURY = 8;
    const STOPPED_CARIOUS_INJURY = 9;
    const INCIPIENT_CARIOUS_INJURY = 10;
    const CARIOUS_CERVICAL_INJURY = 11;
    const RESTORATION_GOOD_STATE = 12;
    const RESTORATION_BAD_STATE = 13;
    const TEMPORARY_RESTORATION = 14;
    const SEALANT_GOOD_STATE = 15;
    const SEALANT_BAD_STATE = 16;

    public static $diseases = [
        self::ABFRACTION => "abfraction",
        self::ABRASION => "abrasion",
        self::ATTRITION => "attrition",
        self::VENEER_GOOD_STATE => "veneer_good_state",
        self::VENEER_BAD_STATE => "veneer_bad_state",
        self::HEALING => "healing",
        self::PACKAGING => "packaging",
        self::EROSION => "erosion",
        self::CARIOUS_INJURY => "carious_injury",
        self::STOPPED_CARIOUS_INJURY => "stopped_carious_injury",
        self::INCIPIENT_CARIOUS_INJURY => "incipient_carious_injury",
        self::CARIOUS_CERVICAL_INJURY => "carious_cervical_injury",
        self::RESTORATION_GOOD_STATE => "restoration_good_state",
        self::RESTORATION_BAD_STATE => "restoration_bad_state",
        self::TEMPORARY_RESTORATION => "temporary_restoration",
        self::SEALANT_GOOD_STATE => "sealant_good_state",
        self::SEALANT_BAD_STATE => "sealant_bad_state"
    ];

    /**
     * Returns the disease text translation.
     *
     * @param integer $diseaseId
     * @return string
     */
    public static function getText(int $diseaseId) {
        return __("tooth_face_disease." . self::$diseases[$diseaseId]);
    }
}
