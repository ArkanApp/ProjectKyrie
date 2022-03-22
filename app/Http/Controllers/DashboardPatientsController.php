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

class DashboardPatientsController extends Controller {
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
        return view("dashboard_patients", [
            "account" => $account, 
            "patientsPaginator" => $account->getPatients()
        ]);
    }

    /**
     * Returns a JSON with all patients that belong to the current logged in account,
     * whose name or last name or both begins with given text.
     *
     * @param string $query
     * @return string
     */
    public function searchPatients(string $query) {
        $patients = Patient::where("name", "LIKE", $query . "%")
            ->orWhere("last_name", "LIKE", $query . "%")
            ->orWhereRaw("CONCAT(last_name, ' ', name) LIKE ?", [$query . '%'])
            ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", [$query . '%'])
            ->where("account_id", Auth::user()->account_id)
            ->select(["patient_id", "name", "last_name", "picture_file"])
            ->get();
        return json_encode(["patients" => $patients]);
    }
}
