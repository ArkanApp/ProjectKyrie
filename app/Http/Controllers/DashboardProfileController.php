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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardProfileController extends Controller {
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
        return view("dashboard_profile", [
            "account" => $account,
            "area" => $account->getArea(),
            "clinic" => $account->getClinic()
        ]);
    }

    /**
     * Modifies Account picture file.
     *
     * @param Request $request
     * @return string
     */
    public function modifyPictureFile(Request $request) {
        $account = Auth::user();
        $validator = Validator::make($request->all(), [
            "picture_file" => ["nullable", "image", "mimes:jpg,jpeg,png", "max:2048"]
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $validator->errors()]);
        }
        if (!$request->hasFile("picture_file")) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $oldPictureFileName = $account->picture_file;
        $account->picture_file = $request->file("picture_file")->store(
            "", "accountPictureFiles"
        );
        if ($oldPictureFileName != null) {
            Storage::disk("accountPictureFiles")->delete($oldPictureFileName);
        }
        try {
            DB::beginTransaction();
            $account->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $exception->getMessage()]);
        }
        return response()->json(["status" => "success", "redirection" => ""]);
    }
}
