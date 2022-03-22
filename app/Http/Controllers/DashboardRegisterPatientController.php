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

namespace App\Http\Controllers;

use App\Patient;
use App\Enums\Gender;
use App\Enums\CivilStatus;
use App\Enums\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DashboardRegisterPatientController extends Controller {
    /**
     * Creates a new instance.
     */
    public function __construct() {
        $this->middleware("auth");
    }

    /**
     * Returns view.
     *
     * @return View
     */
    public function index() {
        $account = Auth::user();
        return view("dashboard_register_patient", [
            "account" => $account,
            "genders" => Gender::$genders,
            "civilStatus" => CivilStatus::$civilStatus,
            "nationalities" => Nationality::$nationalities
        ]);
    }

    /**
     * Registers a new Patient and returns a JSON string with operation status.
     *
     * @param Request $request
     * @return string
     */
    public function registerPatient(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "string", "max:100"],
            "last_name" => ["required", "string", "max:100"],
            "gender" => ["required", "integer", "max:11", Rule::in(Gender::$genderConsts)],
            "birthdate_format" => ["required", "string"],
            "occupation" => ["required", "string", "max:255"],
            "scholarship" => ["required", "string", "max:100"],
            "civil_status" => ["required", "integer", "max:11", Rule::in(CivilStatus::$civilStatusConsts)],
            "nationality" => ["required", "integer", "max:11", Rule::in(Nationality::$nationalityConsts)],
            "email" => ["required", "string", "email", "max:255"],
            "home_phone" => ["required", "string", "min:10", "max:15"],
            "cell_phone" => ["required", "string", "min:10", "max:15"],
            "street1" => ["required", "string", "max:255"],
            "external_number" => ["required", "integer"],
            "internal_number" => ["nullable", "integer"],
            "colony" => ["required", "string", "max:255"],
            "municipality" => ["required", "string", "max:255"],
            "state" => ["required", "string", "max:255"],
            "zipcode" => ["required", "string", "max:10"],
            "picture_file" => ["nullable", "image", "mimes:jpg,jpeg,png", "max:2048"]
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $validator->errors()]);
        }
        $patient = new Patient();
        $patient->account_id = Auth::user()->account_id;
        $patient->name = $request->input("name");
        $patient->last_name = $request->input("last_name");
        $patient->birthdate = \Carbon\Carbon::parse($request->input("birthdate_format"));
        $patient->gender = $request->input("gender");
        $patient->occupation = $request->input("occupation");
        $patient->scholarship = $request->input("scholarship");
        $patient->civil_status = $request->input("civil_status");
        $patient->nationality = $request->input("nationality");
        $patient->email = $request->input("email");
        $patient->home_phone = $request->input("home_phone");
        $patient->cell_phone = $request->input("cell_phone");
        $patient->street1 = $request->input("street1");
        $patient->external_number = $request->input("external_number");
        $patient->internal_number = $request->input("internal_number");
        $patient->colony = $request->input("colony");
        $patient->municipality = $request->input("municipality");
        $patient->state = $request->input("state");
        $patient->zipcode = $request->input("zipcode");
        $patient->register_date = \Carbon\Carbon::now();
        $patient->last_update = \Carbon\Carbon::now();
        if ($request->hasFile("picture_file")) {
            $patient->picture_file = $request->file("picture_file")->store(
                "", "patientPictureFiles"
            );
        }
        try {
            DB::beginTransaction();
            $patient->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $exception]);
        }
        return response()->json([
            "status" => "success", 
            "redirection" => ("#patient/" . $patient->patient_id)
        ]);
    }
}
