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
use App\ToothFaceDisease;
use App\ToothFaceOdontogram;
use App\ToothDisease;
use App\ToothOdontogram;
use App\Enums\ToothDisease as ToothDiseaseEnum;
use App\Enums\ToothFaceDisease as ToothFaceDiseaseEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DashboardOdontogramController extends Controller {

    /**
     * Tooth faces in the illustration.
     *
     * @var array
     */
    private static $toothFaceLayers = [
        "top", "left", "bottom", "right", "center"
    ];

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
     * @param string $type
     * @return View
     */
    public function index(int $patient_id, string $type = "adult") {
        $account = Auth::user();
        if ($account->area_id != 2) {
            return view('errors.404', [
                "messageTitle" => "No autorizado.", 
                "messageDescription" => "Tu área no tiene permiso para acceder a esta función."
            ]);
        }
        $patient = $account->getPatient($patient_id);
        if ($patient == null) {
            return view('errors.404', [
                "messageTitle" => "Paciente no encontrado.", 
                "messageDescription" => "Este paciente no existe. Por favor, intenta nuevamente."
            ]);
        }
        $toothFaceOdontograms = $patient->getToothFaceOdontograms();
        $toothFaceOdontogramsArray = [];
        foreach ($toothFaceOdontograms as $toothFaceOdontogram) {
            $facesWithDiseases = $toothFaceOdontogram->getFacesWithDiseases();
            $toothFaceOdontogramsArray[$toothFaceOdontogram->tooth_number] = [
                "object" => $toothFaceOdontogram,
                "facesWithDiseases" => $facesWithDiseases
            ];
        }
        $toothFaceOdontograms = $toothFaceOdontogramsArray;
        $toothFaceDiseases = DB::table("tooth_face_disease")->join(
            "tooth_face_odontogram", 
            "tooth_face_disease.tooth_face_odontogram_id", "=", "tooth_face_odontogram.tooth_face_odontogram_id"
        )->where("tooth_face_odontogram.patient_id", $patient->patient_id)
         ->select("tooth_face_disease.tooth_face_disease_id", "tooth_face_odontogram.tooth_number")
         ->orderBy("tooth_face_disease.tooth_face_disease_id", "desc")->get();
        $toothDiseases = DB::table("tooth_disease")->join(
            "tooth_odontogram", 
            "tooth_disease.tooth_odontogram_id", "=", "tooth_odontogram.tooth_odontogram_id"
        )->where("tooth_odontogram.patient_id", $patient->patient_id)
         ->select("tooth_disease.tooth_disease_id", "tooth_odontogram.tooth_number", "tooth_disease.disease")
         ->orderBy("tooth_disease.tooth_disease_id", "desc")->get();
        return view("dashboard_odontogram", [
            "account" => $account,
            "patient" => $patient,
            "odontogramType" => $type,
            "toothFaceOdontograms" => $toothFaceOdontograms,
            "toothFaceDiseases" => $toothFaceDiseases,
            "toothDiseases" => $toothDiseases,
            "toothDiseasesArray" => $toothDiseases->toArray(),
            "toothFaceDiseasesEnum" => ToothFaceDiseaseEnum::$diseases,
            "toothDiseasesEnum" => ToothDiseaseEnum::$diseases
        ]);
    }

    /**
     * Adds a tooth disease.
     *
     * @param integer $patient_id
     * @param Request $request
     * @return string
     */
    public function addDisease(int $patient_id, Request $request) {
        $account = Auth::user();
        if ($account->area_id != 2) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $patient = $account->getPatient($patient_id);
        if ($patient == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $formData = $request->input("formData");
        $validator = Validator::make($formData, [
            "tooth_number" => ["required", "integer"],
            "tooth_selected_faces" => ["required_with:tooth_face_diseases", "nullable", "string"],
            "tooth_face_diseases" => ["required_without:tooth_diseases", "nullable", "string"],
            "tooth_diseases" => ["required_without:tooth_face_diseases", "nullable", "string"]
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => "failure", "redirection" => "", "validationErrors" => $validator->errors()]);
        }
        $toothSelectedFaces = array_unique(explode("_", $formData["tooth_selected_faces"]));
        $toothFaceDiseases = array_unique(explode(",", $formData["tooth_face_diseases"]));
        $toothDiseases = array_unique(explode(",", $formData["tooth_diseases"]));
        $toothNumber = $formData["tooth_number"];
        try {
            DB::beginTransaction();
            if (count($toothFaceDiseases) > 0 && !empty($toothFaceDiseases[0])) {
                $toothFaceOdontogram = $patient->getToothFaceOdontogram($toothNumber);
                if ($toothFaceOdontogram == null) {
                    $toothFaceOdontogram = new ToothFaceOdontogram();
                    $toothFaceOdontogram->patient_id = $patient->patient_id;
                    $toothFaceOdontogram->tooth_number = $formData["tooth_number"];
                    $toothFaceOdontogram->save();
                }
                foreach ($toothFaceDiseases as $toothFaceDiseaseId) {
                    if (!$toothFaceOdontogram->registerDisease($toothSelectedFaces, $toothFaceDiseaseId)) {
                        throw new \Exception("Could not register tooth face disease.");
                    }
                }
            }
            if (count($toothDiseases) > 0 && !empty($toothDiseases[0])) {
                $toothOdontogram = $patient->getToothOdontogram($toothNumber);
                if ($toothOdontogram == null) {
                    $toothOdontogram = new ToothOdontogram();
                    $toothOdontogram->patient_id = $patient->patient_id;
                    $toothOdontogram->tooth_number = $formData["tooth_number"];
                    $toothOdontogram->save();
                }
                foreach ($toothDiseases as $toothDiseaseId) {
                    if (!$toothOdontogram->registerDisease($toothDiseaseId)) {
                        throw new \Exception("Could not register tooth disease.");
                    }
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $exception->getMessage()]);
        }
        return response()->json([
            "status" => "success", 
            "redirection" => "#patient/$patient->patient_id/odontogram/" . $request->input("extraData")["o_type"] ?? "adult"
        ]);
    }
}
