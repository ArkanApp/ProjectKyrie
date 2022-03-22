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

use App\ClinicalRecord;
use App\ClinicalRecordField;
use App\ClinicalRecordFieldGroup;
use App\ClinicalRecordFieldOption;
use App\Enums\ClinicalRecordFieldType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardClinicalRecordGeneratorController extends Controller {

    /**
     * Maximum number of options in a multiple options field.
     *
     * @var integer
     */
    private static $maxOptions = 10;

    /**
     * Maximum number of fields in a clinical record.
     *
     * @var integer
     */
    private static $maxFields = 100;

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
        return view("dashboard_clinical_record_generator", [
            "account" => $account
        ]);
    }

    /**
     * Registers a new ClinicalRecord format and associates it to this Account Clinic.
     *
     * @param Request $request
     * @return string
     */
    public function createClinicalRecord(Request $request) {
        $account = Auth::user();
        $formData = $request->input("formData");
        $validator = Validator::make($formData, [
            "name" => ["required", "string", "max:100"]
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $validator->errors()]);
        }
        $formFields = $request->input("extraData");
        try {
            DB::beginTransaction();
            if (count($formFields) > 100) {
                throw new \Exception("Maximum number of fields exceeded.");
            }
            $clinicalRecord = new ClinicalRecord();
            $clinicalRecord->clinic_id = $account->getClinic()->clinic_id;
            $clinicalRecord->name = $formData["name"];
            $clinicalRecord->save();
            foreach ($formFields as $formGroup) {
                $clinicalRecordFieldGroup = new ClinicalRecordFieldGroup();
                $clinicalRecordFieldGroup->clinical_record_id = $clinicalRecord->clinical_record_id;
                $clinicalRecordFieldGroup->title = $formGroup["name"];
                $clinicalRecordFieldGroup->save();
                foreach ($formGroup["fields"] as $formField) {
                    $clinicalRecordField = new ClinicalRecordField();
                    $clinicalRecordField->clinical_record_field_group_id = $clinicalRecordFieldGroup->clinical_record_field_group_id;
                    $clinicalRecordField->title = $formField["name"];
                    $clinicalRecordField->type = $formField["type"];
                    if ($formField["type"] == ClinicalRecordFieldType::DROPDOWN || 
                        $formField["type"] == ClinicalRecordFieldType::RADIO_BUTTONS || 
                        $formField["type"] == ClinicalRecordFieldType::CHECKBOXES
                    ) {
                        $clinicalRecordField->has_multiple_options = true;
                        $clinicalRecordField->save();
                        $optionsCounter = 0;
                        foreach ($formField["options"] as $option) {
                            if ($optionsCounter >= self::$maxOptions) {
                                throw new \Exception("Maximum number of options exceeded.");
                            }
                            $clinicalRecordFieldOption = new ClinicalRecordFieldOption();
                            $clinicalRecordFieldOption->clinical_record_field_id = $clinicalRecordField->clinical_record_field_id;
                            $clinicalRecordFieldOption->option = $option["option"];
                            $clinicalRecordFieldOption->save();
                            $optionsCounter++;
                        }
                    } else {
                        $clinicalRecordField->save();
                    }
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $exception]);
        }
        return response()->json([
            "status" => "success", 
            "redirection" => "#clinicalRecordGenerator"
        ]);
    }
}
