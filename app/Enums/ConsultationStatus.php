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

namespace App\Enums;

abstract class ConsultationStatus {
    const SCHEDULED = 0;
    const RESCHEDULED = 1;
    const IN_PROGRESS = 2;
    const FINISHED = 3;
    const CANCELLED = 4;

    private static $status = [
        self::SCHEDULED => "scheduled",
        self::RESCHEDULED => "rescheduled",
        self::IN_PROGRESS => "in_progress",
        self::FINISHED => "finished",
        self::CANCELLED => "cancelled"
    ];

    /**
     * Returns the status text translation.
     *
     * @param integer $statusId
     * @return string
     */
    public static function getText(int $statusId) {
        return __("consultation_status." . self::$status[$statusId]);
    }
}
