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

use App\Clinic;
use App\Enums\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DashboardController extends Controller {

    /**
     * Creates a new instance.
     */
    public function __construct() {
        $this->middleware("auth");
    }

    /**
     * Returns dashboard view.
     *
     * @return View
     */
    public function index(Request $request) {
        return view("dashboard", ["tz" => $request->toArray()]);
    }

    /**
     * Registers a new clinic.
     *
     * @param Request $request
     * @return string
     */
    public function registerClinic(Request $request) {
        $account = Auth::user();
        if ($account->hasClinic()) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
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
        $clinic = new Clinic();
        $clinic->account_id = $account->account_id;
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
            $clinic->picture_file = $request->file("picture_file")->store(
                "", "clinicPictureFiles"
            );
        }
        try {
            DB::beginTransaction();
            $clinic->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $exception->getMessage()]);
        }
        return response()->json([
            "status" => "success", 
            "redirection" => "#profile"
        ]);
    }

    /**
     * Prepares dashboard for its first use in current sessión.
     * Sets timezone for user's session.
     *
     * @param Request $request
     * @return string
     */
    public function startup(Request $request) {
        if (session("startup") == null) {
            session(["timezone" => $request->timezone, "startup" => true]);
            return response()->json(["status" => "success"]);
        }
        return response()->json(["status" => "set"]);
    }
}
