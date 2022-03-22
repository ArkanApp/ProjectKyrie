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

use App\Enums\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DashboardModifyClinicController extends Controller {
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
        return view("dashboard_modify_clinic", [
            "account" => $account,
            "clinic" => $account->getClinic()
        ]);
    }

    /**
     * Modifies the Account Clinic data.
     *
     * @param Request $request
     * @return string
     */
    public function modifyClinic(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "string", "max:255"],
            "phone" => ["required", "string", "min:10", "max:15"],
            "country" => ["required", "integer", "max:11", Rule::in(Country::$countryConsts)],
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
        $account = Auth::user();
        $clinic = $account->getClinic();
        if ($clinic == null) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $clinic->name = $request->input("name");
        $clinic->phone = $request->input("phone");
        $clinic->country = $request->input("country");
        $clinic->street1 = $request->input("street1");
        $clinic->external_number = $request->input("external_number");
        $clinic->internal_number = $request->input("internal_number");
        $clinic->colony = $request->input("colony");
        $clinic->municipality = $request->input("municipality");
        $clinic->state = $request->input("state");
        $clinic->zipcode = $request->input("zipcode");
        if ($request->hasFile("picture_file")) {
            $oldPictureFileRoute = $clinic->picture_file;
            $clinic->picture_file = $request->file("picture_file")->store(
                "", "clinicPictureFiles"
            );
            if ($oldPictureFileRoute != null) {
                Storage::disk("clinicPictureFiles")->delete($oldPictureFileRoute);
            }
        }
        try {
            DB::beginTransaction();
            $clinic->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        return response()->json([
            "status" => "success", 
            "redirection" => "#profile"
        ]);
    }
}
