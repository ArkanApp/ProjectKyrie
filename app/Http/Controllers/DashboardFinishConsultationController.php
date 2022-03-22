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
use App\EvolutionNote;
use App\Patient;
use App\Prescription;
use App\Enums\ConsultationStatus;
use \Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardFinishConsultationController extends Controller {
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
        if ($consultation->status == ConsultationStatus::CANCELLED || 
            $consultation->status == ConsultationStatus::FINISHED ||
            $consultation->consultation_date > Carbon::now()
        ) {
            return view('errors.404', [
                "messageTitle" => "Imposible finalizar consulta.", 
                "messageDescription" => "Esta consulta no puede ser finalizada porque, o ya lo está, 
                    o está cancelada, o aún no ha llegado el día y hora de la consulta."
            ]);
        }
        $duration = $consultation->consultation_date->diffInMinutes(Carbon::now());
        return view("dashboard_consultation_finish", [
            "account" => $account,
            "patient" => $patient,
            "consultation" => $consultation,
            "duration" => $duration
        ]);
    }

    /**
     * Finishes a Consultation.
     *
     * @param integer $patient_id
     * @param integer $consultation_id
     * @param Request $request
     * @return string
     */
    public function finishConsultation(int $patient_id, int $consultation_id, Request $request) {
        $account = Auth::user();
        $patient = $account->getPatient($patient_id);
        if ($patient == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $consultation = $patient->getConsultation($consultation_id);
        if ($consultation == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        if ($consultation->status == ConsultationStatus::CANCELLED || 
            $consultation->status == ConsultationStatus::FINISHED ||
            $consultation->consultation_date > Carbon::now()
        ) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $formData = $request->input("formData");
        $validator = Validator::make($formData, [
            "duration" => ["required", "integer", "gt:0"],
            "observations" => ["nullable", "string"],
            "prescription_content" => ["nullable", "string"],
            "evolution_note_note" => ["required_with:consultation_date_format", "nullable", "string"],
            "consultation_date_format" => ["required_with_all:evolution_note_note,treatment", "required_with:treatment", "nullable", "date"],
            "treatment" => ["required_with_all:evolution_note_note,consultation_date_format", "required_with:consultation_date_format"],
            "cost" => ["nullable", "numeric"]
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $validator->errors()]);
        }
        try {
            DB::beginTransaction();
            $consultation->duration = $formData["duration"];
            $consultation->observations = $formData["observations"];
            $consultation->cost = $formData["cost"];
            $consultation->status = ConsultationStatus::FINISHED;
            if ($formData["prescription_content"]) {
                $prescription = new Prescription();
                $prescription->content = $formData["prescription_content"];
                $prescription->save();
                $consultation->prescription_id = $prescription->prescription_id;
            }
            if ($formData["evolution_note_note"]) {
                $evolutionNote = new EvolutionNote();
                $evolutionNote->note = $formData["evolution_note_note"];
                if ($formData["consultation_date_format"]) {
                    $newConsultation = new Consultation();
                    $newConsultation->patient_id = $patient->patient_id;
                    $newConsultation->consultation_date = Carbon::parse($formData["consultation_date_format"]);
                    $newConsultation->treatment = $formData["treatment"];
                    $newConsultation->status = ConsultationStatus::SCHEDULED;
                    $newConsultation->save();
                    $evolutionNote->next_consultation_id = $newConsultation->consultation_id;
                }
                $evolutionNote->save();
                $consultation->evolution_note_id = $evolutionNote->evolution_note_id;
            }
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
