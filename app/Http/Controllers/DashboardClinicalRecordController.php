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

use App\ClinicalRecordField;
use App\ClinicalRecordFieldGroup;
use App\ClinicalRecordFieldOption;
use App\ClinicalRecordFieldValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardClinicalRecordController extends Controller {
    /**
     * Clinical record modes.
     *
     * @var array
     */
    private static $modes = [
        "register" => "dashboard_clinical_record_register",
        "modify" => "dashboard_clinical_record_modify",
        "consult" => "dashboard_clinical_record_consult"
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
     * @param integer $clinical_record_id
     * @return View
     */
    public function index(int $patient_id, int $clinical_record_id, string $mode) {
        $account = Auth::user();
        $patient = $account->getPatient($patient_id);
        if ($patient == null) {
            return view('errors.404', [
                "messageTitle" => "Paciente no encontrado.", 
                "messageDescription" => "Este paciente no existe. Por favor, intenta nuevamente."
            ]);
        }
        $clinicalRecord = $account->getClinicalRecord($clinical_record_id);
        if ($clinicalRecord == null) {
            return view('errors.404', [
                "messageTitle" => "Registro clínico no encontrado.", 
                "messageDescription" => "Este registro clínico no existe. Por favor, intenta nuevamente."
            ]);
        }
        if (!array_key_exists($mode, self::$modes)) {
            return view('errors.404');
        }
        return view(self::$modes[$mode], [
            "account" => $account,
            "patient" => $patient,
            "clinicalRecord" => $clinicalRecord
        ]);
    }

    /**
     * Registers a new ClinicalRecord.
     *
     * @param integer $patient_id
     * @param integer $clinical_record_id
     * @param Request $request
     * @return string
     */
    public function registerClinicalRecord(int $patient_id, int $clinical_record_id, Request $request) {
        $account = Auth::user();
        $patient = $account->getPatient($patient_id);
        if ($patient == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $clinicalRecord = $account->getClinicalRecord($clinical_record_id);
        if ($clinicalRecord == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        if ($patient->hasClinicalRecord($clinical_record_id)) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $formData = $request->input("formData");
        try {
            DB::beginTransaction();
            DB::insert(
                "INSERT INTO clinical_record_patient VALUES (?, ?, ?);", 
                [$clinical_record_id, $patient->patient_id, date("Y-m-d", time())]
            );
            foreach ($formData as $fieldDataName => $fieldDataValue) {
                if (empty($fieldDataValue)) {
                    continue;
                }
                $fieldExplode = explode("field_", $fieldDataName);
                if (count($fieldExplode) <= 1) {
                    continue;
                }
                $fieldId = $fieldExplode[1];
                $field = DB::select(
                    "SELECT clinical_record_field_id, has_multiple_options FROM clinical_record_field 
                    WHERE clinical_record_field_id = ? AND clinical_record_field_group_id IN (
                        SELECT clinical_record_field_group_id FROM clinical_record_field_group 
                        WHERE clinical_record_id = ?
                    )", [$fieldId, $clinical_record_id]
                );
                if (count($field) != 1) {
                    continue;
                }
                $field = $field[0];
                if (!$field->has_multiple_options) {
                    $fieldValue = new ClinicalRecordFieldValue();
                    $fieldValue->clinical_record_field_id = $field->clinical_record_field_id;
                    $fieldValue->patient_id = $patient->patient_id;
                    $fieldValue->value = $fieldDataValue;
                    $fieldValue->save();
                } else {
                    $optionIdsArray = is_array($fieldDataValue) ? $fieldDataValue : [$fieldDataValue];
                    $optionIdsArray = array_filter($optionIdsArray, "is_numeric");
                    if (count($optionIdsArray) == 0) {
                        continue;
                    }
                    $selectedPatientOptions = $patient->selectedClinicalRecordFieldOptions($field->clinical_record_field_id);
                    $fieldOptions = $field->getOptions();
                    foreach ($optionIdsArray as $optionId) {
                        if (!$fieldOptions->contains($optionId)) {
                            unset($optionIdsArray[array_search($optionId, $optionIdsArray)]);
                        } else {
                            $selectedPatientOptions->attach($optionId);
                        }
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
            "redirection" => "#patient/$patient->patient_id/clinicalRecord/$clinical_record_id/consult"
        ]);
    }

    /**
     * Modifies a ClinicalRecord.
     *
     * @param integer $patient_id
     * @param integer $clinical_record_id
     * @param Request $request
     * @return string
     */
    public function modifyClinicalRecord(int $patient_id, int $clinical_record_id, Request $request) {
        $account = Auth::user();
        $patient = $account->getPatient($patient_id);
        if ($patient == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $clinicalRecord = $account->getClinicalRecord($clinical_record_id);
        if ($clinicalRecord == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        if (!$patient->hasClinicalRecord($clinical_record_id)) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $formData = $request->input("formData");
        try {
            DB::beginTransaction();
            foreach ($formData as $fieldDataName => $fieldDataValue) {
                if (empty($fieldDataValue)) {
                    continue;
                }
                $fieldExplode = explode("field_", $fieldDataName);
                if (count($fieldExplode) <= 1) {
                    continue;
                }
                $fieldId = $fieldExplode[1];
                $field = ClinicalRecordField::where("clinical_record_field_id", $fieldId)
                    ->select(["clinical_record_field_id", "has_multiple_options"])->get()->first();
                if ($field == null) {
                    continue;
                }
                if (!$field->has_multiple_options) {
                    if ($field->hasValue($patient->patient_id)) {
                        $fieldValue = $field->getFieldValue($patient->patient_id);
                        $fieldValue->value = $fieldDataValue;
                        $fieldValue->save();
                    } else {
                        $fieldValue = new ClinicalRecordFieldValue();
                        $fieldValue->clinical_record_field_id = $field->clinical_record_field_id;
                        $fieldValue->patient_id = $patient->patient_id;
                        $fieldValue->value = $fieldDataValue;
                        $fieldValue->save();
                    }
                } else {
                    $optionIdsArray = is_array($fieldDataValue) ? $fieldDataValue : [$fieldDataValue];
                    $optionIdsArray = array_filter($optionIdsArray, "is_numeric");
                    if (count($optionIdsArray) == 0) {
                        continue;
                    }
                    $selectedPatientOptions = $patient->selectedClinicalRecordFieldOptions($field->clinical_record_field_id);
                    $selectedOptions = $selectedPatientOptions->get();
                    $fieldOptions = $field->getOptions();
                    foreach ($optionIdsArray as $optionId) {
                        if (!$fieldOptions->contains($optionId)) {
                            unset($optionIdsArray[array_search($optionId, $optionIdsArray)]);
                        } else {
                            if (!$selectedOptions->contains($optionId)) {
                                $selectedPatientOptions->attach($optionId);
                            }
                        }
                    }
                    foreach ($selectedOptions as $selectedOption) {
                        if (!in_array($selectedOption->clinical_record_field_option_id, $optionIdsArray)) {
                            $selectedPatientOptions->detach($selectedOption->clinical_record_field_option_id);
                        }
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
            "redirection" => "#patient/$patient->patient_id/clinicalRecord/$clinical_record_id/consult"
        ]);
    }
}
