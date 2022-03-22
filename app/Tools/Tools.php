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

namespace App\Tools;

use App\Enums\ConsultationStatus;
use \Carbon\Carbon;

abstract class Tools {
    /**
     * Converts date to {day month year} format.
     *
     * @param Carbon $date Carbon date
     * @return string
     */
    public static function convertDateToFormattedString(Carbon $date) {
        return $date->translatedFormat("d F, Y");
    }

    /**
     * Converts datetime to {day month year - hour:minute} format, accord to current
     * session timezone.
     *
     * @param Carbon $dateTime Carbon datetime
     * @return string
     */
    public static function convertDateTimeToFormattedString(Carbon $dateTime) {
        return $dateTime->timezone(session("timezone"))->translatedFormat("d M Y - h:i A");
    }

    /**
     * Converts a number to money format.
     *
     * @param mixed $number
     * @return string
     */
    public static function convertToMoney($number) {
        return "$" . \number_format($number, 2);
    }

    /**
     * Creates a JSON string with given consultations for calendar events.
     *
     * @param object $consultations Consultation Eloquent object collection
     * @return string
     */
    public static function createCalendarEvents(object $consultations) {
        $consultationEvents = [];
        foreach ($consultations as $consultation) {
            $patient = $consultation->getPatient();
            $consultationEvents[] = [
                "id" => $consultation->consultation_id,
                "title" => $patient->getFullName() . " - " . $consultation->treatment,
                "description" => $consultation->observations,
                "start" => $consultation->consultation_date,
                "allDay" => false,
                "patient" => [
                    "id" => $patient->patient_id,
                    "pictureFile" => $patient->getPictureFile(),
                    "fullName" => $patient->getFullName()
                ],
                "status" => ConsultationStatus::getText($consultation->status),
                "treatment" => $consultation->treatment
            ];
            // print_r($consultationEvents);
        }
        return json_encode($consultationEvents);
    }
}
