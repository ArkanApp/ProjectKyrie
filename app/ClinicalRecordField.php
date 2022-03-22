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

namespace App;

use App\ClinicalRecordFieldOption;
use App\ClinicalRecordFieldValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClinicalRecordField extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "clinical_record_field";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "clinical_record_field_id";

    /**
     * True if there are columns for creation and update dates.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "clinical_record_field_id" => "integer",
        "clinical_record_field_group_id" => "integer",
        "type" => "integer",
        "has_multiple_options" => "boolean"
    ];

    /**
     * The attributes that must be casted to date type.
     *
     * @var array
     */
    protected $dates = [
    ];

    /**
     * Returns ClinicalRecordFieldValue value attribute of this ClinicalRecordField that belongs
     * to the given Patient ID.
     *
     * @param int $patient_id
     * @return string
     */
    public function getValue(int $patient_id) {
        $fieldValue = ClinicalRecordFieldValue::where([
            "clinical_record_field_id" => $this->clinical_record_field_id, 
            "patient_id" => $patient_id
        ])->select("value")->get()->first();
        return $fieldValue != null ? $fieldValue->value : "";
    }

    /**
     * Returns the ClinicalRecordFieldValue attached to this ClinicalRecordField.
     *
     * @param integer $patient_id
     * @return ClinicalReecordFieldValue
     */
    public function getFieldValue(int $patient_id) {
        return ClinicalRecordFieldValue::where([
            "clinical_record_field_id" => $this->clinical_record_field_id, 
            "patient_id" => $patient_id
        ])->get()->first();
    }

    /**
     * Returns true if this field has a value assigned by a Patient; false if not.
     *
     * @param integer $patient_id
     * @return boolean
     */
    public function hasValue(int $patient_id) {
        return !empty($this->getValue($patient_id));
    }

    /**
     * Returns true if this field has 1 or more options selected by a Patient; false if not.
     *
     * @param integer $patient_id
     * @return boolean
     */
    public function hasSelectedOptions(int $patient_id) {
        return DB::table("clinical_record_field_option_patient")->where("patient_id", $patient_id)
            ->whereIn(
                "clinical_record_field_option_id",
                ClinicalRecordFieldOption::where("clinical_record_field_id", $this->clinical_record_field_id)
                    ->select("clinical_record_field_option_id")
            )->select("clinical_record_field_option_id")->count() > 0;
    }

    /**
     * Returns all options attached to this field.
     *
     * @return array array of ClinicalRecordFieldOption
     */
    public function getOptions() {
        return ClinicalRecordFieldOption::where(
            "clinical_record_field_id", $this->clinical_record_field_id
        )->get();
    }

    /**
     * Returns all options selected by a Patient that belongs to this field.
     *
     * @param integer $patient_id
     * @return array array of ClinicalRecordFieldOption
     */
    public function getSelectedOptions(int $patient_id) {
        return ClinicalRecordFieldOption::where("clinical_record_field_id", $this->clinical_record_field_id)
            ->whereIn(
                "clinical_record_field_option_id", 
                DB::table("clinical_record_field_option_patient")->where("patient_id", $patient_id)
                    ->select("clinical_record_field_option_id")
            )->get();
    }

    public function options() {
        return $this->hasMany('App\ClinicalRecordFieldOption', 'clinical_record_field_id', 'clinical_record_field_id');
    }
}
