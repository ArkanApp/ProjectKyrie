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
use App\Enums\ConsultationStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardStatsController extends Controller {
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
        $stats = new \stdClass();
        $stats->today = [
            "patients" => $account->patients()->whereDate("register_date", Carbon::today())->count(),
            "consultations" => $consultations = Consultation::whereIn(
                    "patient_id", $account->patients()->select("patient_id")
                )->where("status", ConsultationStatus::FINISHED)->whereDate("consultation_date", Carbon::today())
                 ->select("consultation_id", "cost"),
            "amountConsultations" => 0,
            "earnings" => 0
        ];
        $stats->today["amountConsultations"] = $stats->today["consultations"]->count();
        $stats->today["earnings"] = $stats->today["consultations"]->sum("cost");

        $stats->this_week = [
            "patients" => $account->patients()->whereBetween("register_date", [
                    Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()
                ])->count(),
            "consultations" => $consultations = Consultation::whereIn(
                    "patient_id", $account->patients()->select("patient_id")
                )->where("status", ConsultationStatus::FINISHED)->whereBetween("consultation_date", [
                    Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()
                ])->select("consultation_id", "cost"),
            "amountConsultations" => 0,
            "earnings" => 0
        ];
        $stats->this_week["amountConsultations"] = $stats->this_week["consultations"]->count();
        $stats->this_week["earnings"] = $stats->this_week["consultations"]->sum("cost");

        $stats->all_time = [
            "patients" => $account->patients()->count(),
            "consultations" => $consultations = Consultation::whereIn(
                    "patient_id", $account->patients()->select("patient_id")
                )->where("status", ConsultationStatus::FINISHED)
                ->select("consultation_id", "cost"),
            "amountConsultations" => 0,
            "earnings" => 0
        ];
        $stats->all_time["amountConsultations"] = $stats->all_time["consultations"]->count();
        $stats->all_time["earnings"] = $stats->all_time["consultations"]->sum("cost");
        return view("dashboard_stats", [
            "account" => $account,
            "stats" => $stats
        ]);
    }
}
