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

abstract class ToothDisease {
    const PROVISIONAL = 0;
    const ANOMALIES_TOOTH_SHAPE = 1;
    const TOOTH_CROWN_GOOD_STATE = 2;
    const TOOTH_CROWN_BAD_STATE = 3;
    const DIASTEMA = 4;
    const YELLOW_TOOTH = 5;
    const MISSING_TOOTH = 6;
    const CLINICALLY_MISSING_TOOTH = 7;
    const EXTRUDED_TOOTH = 8;
    const ROTATED_TOOTH = 9;
    const PRESENT_TOOTH = 10;
    const SEMIERUPTED_TOOTH = 11;
    const SUPERNUMERARY_TOOTH = 12;
    const CARVED_TOOTH_NO_CROWN = 13;
    const PERSISTENT_TEMPORARY_TOOTH = 14;
    const FISTULA = 15;
    const CORONARY_DENTAL_FRACTURE = 16;
    const ROOT_FRACTURE = 17;
    const IMPLANT_GOOD_STATE = 18;
    const IMPLANT_BAD_STATE = 19;
    const INDICATED_TO_EXTRACT = 20;
    const MALPOSITION = 21;
    const MICRODONTIA = 22;
    const PONTIC = 23;
    const PONTIC_BAD_STATE = 24;
    const NECROTIC_PULP = 25;
    const ROOT_REMAINDER = 26;
    const ROOT_CANAL_TREATMENT = 27;
    const ROOT_CANAL_TREATMENT_BAD_STATE = 28;

    public static $diseases = [
        self::PROVISIONAL => "provisional",
        self::ANOMALIES_TOOTH_SHAPE => "anomalies_tooth_shape",
        self::TOOTH_CROWN_GOOD_STATE => "tooth_crown_good_state",
        self::TOOTH_CROWN_BAD_STATE => "tooth_crown_bad_state",
        self::DIASTEMA => "diastema",
        self::YELLOW_TOOTH => "yellow_tooth",
        self::MISSING_TOOTH => "missing_tooth",
        self::CLINICALLY_MISSING_TOOTH => "clinically_missing_tooth",
        self::EXTRUDED_TOOTH => "extruded_tooth",
        self::ROTATED_TOOTH => "rotated_tooth",
        self::PRESENT_TOOTH => "present_tooth",
        self::SEMIERUPTED_TOOTH => "semierupted_tooth",
        self::SUPERNUMERARY_TOOTH => "supernumerary_tooth",
        self::CARVED_TOOTH_NO_CROWN => "carved_tooth_no_crown",
        self::PERSISTENT_TEMPORARY_TOOTH => "persistent_temporary_tooth",
        self::FISTULA => "fistula",
        self::CORONARY_DENTAL_FRACTURE => "coronary_dental_fracture",
        self::ROOT_FRACTURE => "root_fracture",
        self::IMPLANT_GOOD_STATE => "implant_good_state",
        self::IMPLANT_BAD_STATE => "implant_bad_state",
        self::INDICATED_TO_EXTRACT => "indicated_to_extract",
        self::MALPOSITION => "malposition",
        self::MICRODONTIA => "microdontia",
        self::PONTIC => "pontic",
        self::PONTIC_BAD_STATE => "pontic_bad_state",
        self::NECROTIC_PULP => "necrotic_pulp",
        self::ROOT_REMAINDER => "root_remainder",
        self::ROOT_CANAL_TREATMENT => "root_canal_treatment",
        self::ROOT_CANAL_TREATMENT_BAD_STATE => "root_canal_treatment_bad_state"
    ];

    /**
     * Returns the disease text translation.
     *
     * @param integer $diseaseId
     * @return string
     */
    public static function getText(int $diseaseId) {
        return __("tooth_disease." . self::$diseases[$diseaseId]);
    }
}
