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

use App\Area;
use App\Clinic;
use App\ClinicalRecord;
use App\Consultation;
use App\Enums\SubscriptionStatus;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Account extends Authenticatable {
    use Notifiable;

    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "account";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "account_id";

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
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "account_id" => "integer",
        "area_id" => "integer",
        "verified" => "boolean",
        "is_student" => "boolean"
    ];

    /**
     * The attributes that must be casted to date type.
     *
     * @var array
     */
    protected $dates = [
        "register_date"
    ];

    /**
     * Returns a relationship builder between this Account and its Patients.
     *
     * @return Builder
     */
    public function patients() {
        return $this->hasMany("App\Patient", "account_id", "account_id");
    }

    /**
     * Returns the Area where this Account belongs to.
     *
     * @return Area
     */
    public function getArea() {
        return Area::find($this->area_id);
    }

    /**
     * Returns the Clinic associated to this Account.
     *
     * @return Clinic
     */
    public function getClinic() {
        return Clinic::where("account_id", $this->account_id)->get()->first();
    }

    /**
     * Returns 20 patients by pagination.
     *
     * @return array array of Patients
     */
    public function getPatients() {
        return Patient::where("account_id", $this->account_id)->orderBy("patient_id", "desc")->paginate(10);
    }

    /**
     * Returns a Patient with given ID that belongs to this account.
     *
     * @param integer $patientId
     * @return Patient
     */
    public function getPatient(int $patient_id) {
        $patient = Patient::where([
            "patient_id" => $patient_id, 
            "account_id" => $this->account_id
        ])->get()->first();
        return $patient;
    }

    /**
     * Returns all consultations from a month. If month is not given or is equal to zero,
     * then today's month will be used.
     *
     * @param int $month
     * @return array array of Consultation
     */
    public function getMonthConsultations(int $month = 0) {
        $month = $month == 0 ? Carbon::now()->month : $month;
        $minDate = Carbon::now();
        $minDate->month = $month;
        $minDate = $minDate->startOfMonth();
        $maxDate = Carbon::now();
        $maxDate->month = $month;
        $maxDate = $maxDate->endOfMonth();
        return Consultation::whereBetween("consultation_date", [$minDate, $maxDate])
            ->whereIn("patient_id", Patient::where("account_id", $this->account_id)->select("patient_id"))
            ->get();
    }

    /**
     * Returns all consultations for today.
     *
     * @return array array of Consultation
     */
    public function getTodayConsultations() {
        return Consultation::where(
            "consultation_date", ">=", Carbon::today()
        )->where(
            "consultation_date", "<", Carbon::tomorrow()
        )->whereIn("patient_id", Patient::where("account_id", $this->account_id)->select("patient_id"))
         ->get();
    }

    /**
     * Returns first 20 Consultations by pagination.
     *
     * @return array array of Consultations
     */
    public function getConsultations() {
        return Consultation::whereIn("patient_id", Patient::where("account_id", $this->account_id)->select("patient_id"))
            ->orderBy("consultation_id", "desc")->paginate(20);
    }

    /**
     * Returns a collection of Consultations where their consultation date
     * is between the given start and end date.
     *
     * @param string $startDate Date format must be Y-m-d
     * @param string $endDate Date format must be Y-m-d
     * @return array array of Consultation
     */
    public function getFilteredConsultations(string $startDate, string $endDate) {
        $minDate = Carbon::createFromFormat("Y-m-d", $startDate);
        $maxDate = Carbon::createFromFormat("Y-m-d", $endDate);
        $consultations = Consultation::whereBetween("consultation_date", [$minDate, $maxDate])
            ->whereIn("patient_id", Patient::where("account_id", $this->account_id)->select("patient_id"))
            ->get();
        return $consultations;
    }

    /**
     * Returns a ClinicalRecord where its ID equals to the given one and the Clinic ID
     * equals to the attached one to this Account or equals to null.
     *
     * @param integer $clinical_record_id
     * @return ClinicalRecord
     */
    public function getClinicalRecord(int $clinical_record_id) {
        $clinic = Clinic::where("account_id", $this->account_id)->select("clinic_id")->get()->first();
        $clinicId = null;
        if ($clinic != null) {
            $clinicId = $clinic->clinic_id;
        }
        return ClinicalRecord::where([
            "clinical_record_id" => $clinical_record_id,
            "clinic_id" => $clinicId
        ])->orWhere(function ($query) use ($clinical_record_id) {
            $query->where("clinical_record_id", $clinical_record_id)->where("clinic_id", null);
        })->get()->first();
    }

    /**
     * Returns all ClinicalRecords created by this Account and those that are global.
     *
     * @return array array of ClinicalRecord
     */
    public function getClinicalRecords() {
        $clinic = Clinic::where("account_id", $this->account_id)->select("clinic_id")->get()->first();
        $clinicId = null;
        if ($clinic != null) {
            $clinicId = $clinic->clinic_id;
        }
        return ClinicalRecord::where("clinic_id", $clinicId)->orWhere("clinic_id", null)->get();
    }

    /**
     * Returns name and last name.
     *
     * @return string
     */
    public function getFullName() {
        return $this->name . " " . $this->last_name;
    }

    /**
     * Returns an URL string to show the picture file.
     *
     * @return string
     */
    public function getPictureFile() {
        if ($this->picture_file == null) {
            return Storage::url("accounts/pictureFiles/default.png");
        }
        return route("private_images_manager_picture_file", [
            "disk" => "accountPictureFiles", 
            "fileName" => $this->picture_file
        ]);
    }

    /**
     * Returns the current active subscription.
     *
     * @return Subscription
     */
    public function getActiveSubscription() {
        return Subscription::where("account_id", $this->account_id)
            ->where("end_date", ">", Carbon::now())
            ->where("status", SubscriptionStatus::ACTIVE)->get()->first();
    }

    /**
     * Returns the current subscription.
     *
     * @return Subscription
     */
    public function getCurrentSubscription() {
        return Subscription::where("account_id", $this->account_id)
            ->where("end_date", ">", Carbon::now())->get()->first();
    }

    /**
     * Returns true if there is an active subscription; false if not.
     *
     * @return boolean
     */
    public function hasAnActiveSubscription() {
        return Subscription::where("account_id", $this->account_id)
            ->where("end_date", ">", Carbon::now())
            ->where("status", SubscriptionStatus::ACTIVE)
            ->count() == 1;
    }

    /**
     * Returns true if this Account has a registered Clinic; false if not.
     *
     * @return boolean
     */
    public function hasClinic() {
        return Clinic::where("account_id", $this->account_id)->exists();
    }
}
