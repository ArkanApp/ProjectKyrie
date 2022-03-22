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

use App\Consultation;
use App\Patient;
use App\Enums\ConsultationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardRegisterConsultationController extends Controller {
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
    public function index(int $patient_id) {
        $account = Auth::user();
        $patient = $account->getPatient($patient_id);
        if ($patient == null) {
            return view('errors.404', [
                "messageTitle" => "Paciente no encontrado.", 
                "messageDescription" => "Este paciente no existe. Por favor, intenta nuevamente."
            ]);
        }
        return view("dashboard_register_consultation", [
            "account" => $account,
            "patient" => $patient
        ]);
    }

    /**
     * Registers a new Consultation.
     *
     * @param integer $patient_id
     * @param Request $request
     * @return string
     */
    public function registerConsultation(int $patient_id, Request $request) {
        $account = Auth::user();
        $patient = $account->getPatient($patient_id);
        if ($patient == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $formData = $request->input("formData");
        $validator = Validator::make($formData, [
            "consultation_date_format" => ["required", "string"],
            "treatment" => ["required", "string", "max:65535"]
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $validator->errors()]);
        }
        $consultation = new Consultation();
        $consultation->patient_id = $patient->patient_id;
        $consultation->consultation_date = \Carbon\Carbon::parse($formData["consultation_date_format"]);
        $consultation->treatment = $formData["treatment"];
        $consultation->status = ConsultationStatus::SCHEDULED;
        try {
            DB::beginTransaction();
            $consultation->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $exception]);
        }
        return response()->json([
            "status" => "success", 
            "redirection" => "#patient/$patient->patient_id/consultation/$consultation->consultation_id/details"
        ]);
    }
}
