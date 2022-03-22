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

use App\ClinicalRecordField;
use App\ClinicalRecordFieldGroup;
use App\Tools\Tools;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClinicalRecord extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "clinical_record";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "clinical_record_id";

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
        "clinical_record_id" => "integer",
        "clinic_id" => "integer"
    ];

    /**
     * The attributes that must be casted to date type.
     *
     * @var array
     */
    protected $dates = [
    ];

    /**
     * Returns all field groups attached to this ClinicalRecord.
     *
     * @return array array of ClinicalRecordFieldGroup
     */
    public function getGroups() {
        return ClinicalRecordFieldGroup::where("clinical_record_id", $this->clinical_record_id)->get();
    }

    /**
     * Returns register date as a formatted string.
     *
     * @param integer $patient_id
     * @return string
     */
    public function getRegisterDate(int $patient_id) {
        $clinicalRecordPatient = DB::table("clinical_record_patient")->where([
            "clinical_record_id" => $this->clinical_record_id,
            "patient_id" => $patient_id
        ])->select("register_date")->get()->first();
        return Tools::convertDateToFormattedString(Carbon::parse($clinicalRecordPatient->register_date));
    }

    /**
     * Returns true if all fields have a value or a selected option; false if not.
     *
     * @param integer $patient_id
     * @return boolean
     */
    public function hasAllFieldsFilled(int $patient_id) {
        $fields = ClinicalRecordField::whereIn(
            "clinical_record_field_group_id", 
            ClinicalRecordFieldGroup::where("clinical_record_id", $this->clinical_record_id)
                ->select("clinical_record_field_group_id")
        )->select(["clinical_record_field_id", "has_multiple_options"])->get();
        foreach ($fields as $field) {
            if (!$field->has_multiple_options) {
                if (!$field->hasValue($patient_id)) {
                    return false;
                }
            } else {
                if (!$field->hasSelectedOptions($patient_id)) {
                    return false;
                }
            }
        }
        return true;
    }
}
