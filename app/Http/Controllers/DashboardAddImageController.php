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

use App\Image;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardAddImageController extends Controller {
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
        return view("dashboard_add_image", [
            "account" => $account,
            "patient" => $patient
        ]);
    }

    /**
     * Adds a new Image.
     *
     * @param integer $patient_id
     * @param Request $request
     * @return string
     */
    public function addImage(int $patient_id, Request $request) {
        $account = Auth::user();
        $patient = $account->getPatient($patient_id);
        if ($patient == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $validator = Validator::make($request->all(), [
            "title" => ["required", "string", "max:255"],
            "image" => ["required", "image", "max:8096"]
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $validator->errors()]);
        }
        $image = new Image();
        $image->patient_id = $patient->patient_id;
        $image->title = $request->input("title");
        $image->file_name = $request->file("image")->store(
            "", "patientImages"
        );
        $image->upload_date = date("Y-m-d", time());
        try {
            DB::beginTransaction();
            $image->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        return response()->json([
            "status" => "success", 
            "redirection" => "#patient/$patient->patient_id/images"
        ]);
    }
}
