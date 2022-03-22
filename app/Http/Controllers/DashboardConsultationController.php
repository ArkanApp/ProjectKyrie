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
use App\Enums\ConsultationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardConsultationController extends Controller {
    /**
     * Creates a new instance.
     */
    public function __construct() {
        $this->middleware("auth");
    }

    /**
     * Returns view.
     *
     * @param integer $patient_id
     * @param integer $consultation_id
     * @return View
     */
    public function index(int $patient_id, int $consultation_id) {
        $account = Auth::user();
        $patient = $account->getPatient($patient_id);
        if ($patient == null) {
            return view('errors.404', [
                "messageTitle" => "Paciente no encontrado.", 
                "messageDescription" => "Este paciente no existe. Por favor, intenta nuevamente."
            ]);
        }
        $consultation = $patient->getConsultation($consultation_id);
        if ($consultation == null) {
            return view('errors.404', [
                "messageTitle" => "Consulta no encontrada.", 
                "messageDescription" => "Esta consulta no existe. Por favor, intenta nuevamente."
            ]);
        }
        return view("dashboard_consultation", [
            "account" => $account,
            "patient" => $patient,
            "consultation" => $consultation
        ]);
    }

    /**
     * Reschedules a Consultation.
     *
     * @return string
     */
    public function rescheduleConsultation(int $patient_id, Request $request) {
        $account = Auth::user();
        $patient = $account->getPatient($patient_id);
        if ($patient == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $formData = $request->input("formData");
        $validator = Validator::make($formData, [
            "consultation_id" => ["required", "integer"],
            "consultation_date_format" => ["required", "date"]
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $validator->errors()]);
        }
        $consultation = $patient->getConsultation($formData["consultation_id"]);
        if ($consultation == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        if ($consultation->status == ConsultationStatus::RESCHEDULED || 
            $consultation->status == ConsultationStatus::CANCELLED ||
            $consultation->status == ConsultationStatus::FINISHED
        ) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $consultation->consultation_date = \Carbon\Carbon::parse($formData["consultation_date_format"]);
        $consultation->status = ConsultationStatus::RESCHEDULED;
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

    /**
     * Cancels a Consultation.
     *
     * @return string
     */
    public function cancelConsultation(int $patient_id, Request $request) {
        $account = Auth::user();
        $patient = $account->getPatient($patient_id);
        if ($patient == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $formData = $request->input("formData");
        $validator = Validator::make($formData, [
            "consultation_id" => ["required", "integer"]
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $validator->errors()]);
        }
        $consultation = $patient->getConsultation($formData["consultation_id"]);
        if ($consultation == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        if ($consultation->status == ConsultationStatus::CANCELLED ||
            $consultation->status == ConsultationStatus::FINISHED
        ) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $consultation->status = ConsultationStatus::CANCELLED;
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
