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

namespace App;

use App\ToothDisease;
use App\Enums\ToothDisease as ToothDiseaseEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ToothOdontogram extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "tooth_odontogram";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "tooth_odontogram_id";

    /**
     * True if there are columns for creation and update dates.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "tooth_odontogram_id" => "integer",
        "patient_id" => "integer",
        "tooth_number" => "integer",
    ];

    /**
     * The attributes that must be casted to date type.
     *
     * @var array
     */
    protected $dates = [
        "register_date"
    ];

    /**
     * Registers a new ToothDisease.
     *
     * @param integer $toothDiseaseId
     * @return boolean
     */
    public function registerDisease(int $toothDiseaseId) {
        if (!array_key_exists($toothDiseaseId, ToothDiseaseEnum::$diseases)) {
            return false;
        }
        $toothDisease = new ToothDisease();
        $toothDisease->tooth_odontogram_id = $this->tooth_odontogram_id;
        $toothDisease->register_date = date("Y-m-d", time());
        $toothDisease->disease = $toothDiseaseId;
        try {
            DB::beginTransaction();
            $toothDisease->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
        return true;
    }
}
