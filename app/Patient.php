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

use App\ClinicalRecord;
use App\EvolutionNote;
use App\Image;
use App\ToothFaceOdontogram;
use App\ToothOdontogram;
use App\Enums\Gender;
use App\Enums\CivilStatus;
use App\Enums\Nationality;
use App\Tools\Tools;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Patient extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "patient";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "patient_id";

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
        "patient_id" => "integer",
        "account_id" => "integer",
        "civil_status" => "integer",
        "nationality" => "integer",
        "external_number" => "integer",
        "internal_number" => "integer",
    ];

    /**
     * The attributes that must be casted to date type.
     *
     * @var array
     */
    protected $dates = [
        "birthdate",
        "register_date",
        "last_update"
    ];

    /**
     * Returns name and last name.
     *
     * @return string
     */
    public function getFullName() {
        return $this->name . " " . $this->last_name;
    }

    /**
     * Returns birthdate string accord to app language.
     *
     * @param boolean $showAge true if shall show age; false if not
     * @return string
     */
    public function getBirthdate(bool $showAge = false) {
        return Tools::convertDateToFormattedString($this->birthdate) . (
            $showAge ? " (" . Carbon::now()->longAbsoluteDiffForHumans($this->birthdate) . ")" : ""
        );
    }

    /**
     * Returns gender text.
     *
     * @return string
     */
    public function getGender() {
        return Gender::getText($this->gender);
    }

    /**
     * Returns civil status text.
     *
     * @return string
     */
    public function getCivilStatus() {
        return CivilStatus::getText($this->civil_status);
    }

    /**
     * Returns nationality text.
     *
     * @return string
     */
    public function getNationality() {
        return Nationality::getText($this->nationality);
    }

    /**
     * Returns register date as a formatted string.
     *
     * @return string
     */
    public function getRegisterDate() {
        return Tools::convertDateToFormattedString($this->register_date);
    }

    /**
     * Returns last update as a formatted string.
     *
     * @return string
     */
    public function getLastUpdate() {
        return Tools::convertDateToFormattedString($this->last_update);
    }

    /**
     * Returns picture file URL.
     *
     * @return string
     */
    public function getPictureFile() {
        if ($this->picture_file == null) {
            return Storage::url("patients/pictureFiles/default.png");
        }
        return route("private_images_manager_picture_file", [
            "disk" => "patientPictureFiles", 
            "fileName" => $this->picture_file
        ]);
    }

    /**
     * Returns a Consultation that has the given ID and belongs to this Patient.
     *
     * @param integer $consultation_id
     * @return Consultation
     */
    public function getConsultation(int $consultation_id) {
        return Consultation::where([
            "patient_id" => $this->patient_id, 
            "consultation_id" => $consultation_id
        ])->get()->first();
    }

    /**
     * Returns the last 20 Consultations by pagination.
     *
     * @return array array of Consultation
     */
    public function getConsultations() {
        return Consultation::where("patient_id", $this->patient_id)
            ->orderBy("consultation_id", "desc")->paginate(20);
    }

    /**
     * Returns all clinical records from this Patient.
     *
     * @return array array of ClinicalRecord
     */
    public function getClinicalRecords() {
        return ClinicalRecord::whereIn(
            "clinical_record_id",
            DB::table("clinical_record_patient")
                ->where("patient_id", $this->patient_id)
                ->select("clinical_record_id")
        )->get();
    }

    /**
     * Returns true if there is a clinical record with given ID attached
     * to this Patient.
     *
     * @param int $clinical_record_id
     * @return boolean
     */
    public function hasClinicalRecord(int $clinical_record_id) {
        return count(DB::select(
            "SELECT clinical_record_id FROM clinical_record_patient WHERE clinical_record_id = ? AND patient_id = ?",
            [$clinical_record_id, $this->patient_id]
        )) == 1;
    }

    /**
     * Returns all Images that belong to this Patient.
     *
     * @return array array of Image
     */
    public function getImages() {
        return Image::where("patient_id", $this->patient_id)->get();
    }

    /**
     * Returns all EvolutionNotes from this Patient.
     *
     * @return array array of EvolutionNote
     */
    public function getEvolutionNotes() {
        return EvolutionNote::whereIn(
            "evolution_note_id", 
            Consultation::where("patient_id", $this->patient_id)->select("evolution_note_id")
        )->get();
    }

    /**
     * Returns all ToothFaceOdontogram attached to this Patient.
     *
     * @return array array of ToothFaceOdontogram
     */
    public function getToothFaceOdontograms() {
        return ToothFaceOdontogram::where("patient_id", $this->patient_id)->get();
    }

    /**
     * Returns a ToothFaceOdontogram with the given tooth number.
     *
     * @param integer $tooth_number
     * @return ToothFaceOdontogram
     */
    public function getToothFaceOdontogram(int $tooth_number) {
        return ToothFaceOdontogram::where([
            "patient_id" => $this->patient_id, 
            "tooth_number" => $tooth_number
        ])->get()->first();
    }

    /**
     * Returns a ToothFaceOdontogram with the given tooth number.
     *
     * @param integer $tooth_number
     * @return ToothFaceOdontogram
     */
    public function getToothOdontogram(int $tooth_number) {
        return ToothOdontogram::where([
            "patient_id" => $this->patient_id, 
            "tooth_number" => $tooth_number
        ])->get()->first();
    }

    /**
     * Returns a many to many relationship builder with ClinicalRecordFieldOptions that
     * contains all the options selected by this Patient in a ClinicalRecordField.
     *
     * @param integer $clinical_record_field_id
     * @return Builder
     */
    public function selectedClinicalRecordFieldOptions(int $clinical_record_field_id) {
        return $this->belongsToMany(
            "App\ClinicalRecordFieldOption",
            "clinical_record_field_option_patient",
            "patient_id",
            "clinical_record_field_option_id"
        )->whereIn(
            "clinical_record_field_option_patient.clinical_record_field_option_id",
            ClinicalRecordFieldOption::where("clinical_record_field_id", $clinical_record_field_id)
                ->select("clinical_record_field_option_id")
        );
    }
}
