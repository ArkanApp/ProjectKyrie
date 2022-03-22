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

abstract class ClinicalRecordFieldType {
    const INPUT_TEXT = 0;
    const TEXT_AREA = 1;
    const DROPDOWN = 2;
    const RADIO_BUTTONS = 3;
    const CHECKBOXES = 4;

    public static $typesConsts = [
        self::INPUT_TEXT, self::TEXT_AREA, self::DROPDOWN, self::RADIO_BUTTONS, self::CHECKBOXES
    ];

    public static $typesData = [
        self::INPUT_TEXT => "input_text",
        self::TEXT_AREA => "text_area",
        self::DROPDOWN => "dropdown",
        self::RADIO_BUTTONS => "radio_buttons",
        self::CHECKBOXES => "checkboxes"
    ];

    /**
     * Returns the field type text translation.
     *
     * @param integer $fieldTypeId
     * @return string
     */
    public static function getText(int $fieldTypeId) {
        return __("clinical_record_field_type." . self::$typesData[$fieldTypeId]);
    }
}
