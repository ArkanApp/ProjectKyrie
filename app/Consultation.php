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

use App\Patient;
use App\EvolutionNote;
use App\Prescription;
use App\Tools\Tools;
use App\Enums\ConsultationStatus;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "consultation";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "consultation_id";

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
        "consultation_id" => "integer",
        "patient_id" => "integer",
        "evolution_note_id" => "integer",
        "prescription_id" => "integer",
        "duration" => "integer",
        "cost" => "number",
        "status" => "integer",
    ];

    /**
     * The attributes that must be casted to date type.
     *
     * @var array
     */
    protected $dates = [
        "consultation_date"
    ];

    /**
     * Returns the Patient attached to this Consultation.
     *
     * @return Patient
     */
    public function getPatient() {
        return Patient::where("patient_id", $this->patient_id)->select(
            ["patient_id", "name", "last_name", "picture_file"]
        )->get()->first();
    }

    /**
     * Returns status text.
     *
     * @return string
     */
    public function getStatus() {
        return ConsultationStatus::getText($this->status);
    }

    /**
     * Returns consultation date as a formatted string.
     *
     * @return string
     */
    public function getConsultationDate() {
        return Tools::convertDateTimeToFormattedString($this->consultation_date);
    }

    /**
     * Returns cost attribute in money format. If it is null, a not defined
     * string will be returned.
     *
     * @return string
     */
    public function getCost() {
        return $this->cost != null ? Tools::convertToMoney($this->cost) : __("dashboard.not_defined");
    }

    /**
     * Returns the Prescription attached to this Consultation.
     *
     * @return Prescription
     */
    public function getPrescription() {
        return $this->prescription_id != null ? Prescription::where(
            "prescription_id", $this->prescription_id
        )->get()->first() : null;
    }

    /**
     * Returns the EvolutionNote attacheed to this Consultation.
     *
     * @return EvolutionNote
     */
    public function getEvolutionNote() {
        return $this->evolution_note_id != null ? EvolutionNote::where(
            "evolution_note_id", $this->evolution_note_id
        )->get()->first() : null;
    }
}
