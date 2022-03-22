<?php

namespace App\Http\Controllers;

use App\ConsultationStatus;
use App\Tools\Tools;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardHomeController extends Controller {
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
        $consultations = $account->getMonthConsultations();
        $consultationEvents = Tools::createCalendarEvents($consultations);
        return view("dashboard_home", [
            "account" => $account, 
            "events" => $consultationEvents,
            "todayConsultations" => $account->getTodayConsultations()
        ]);
    }

    /**
     * Returns a JSON string with filtered consultations by a range of dates.
     *
     * @param string $startDate
     * @param string $endDate
     * @return string
     */
    public function getFilteredConsultations(string $startDate, string $endDate) {
        $consultations = Auth::user()->getFilteredConsultations($startDate, $endDate);
        $consultationEvents = Tools::createCalendarEvents($consultations);
        return response()->json($consultationEvents);
    }
}
