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

use App\Enums\ToothDisease as ToothDiseaseEnum;
use Illuminate\Database\Eloquent\Model;

class ToothDisease extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "tooth_disease";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "tooth_disease_id";

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
        "tooth_disease_id" => "integer",
        "tooth_odontogram_id" => "integer",
        "disease" => "integer"
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
     * Returns disease name.
     *
     * @return string
     */
    public function getDisease() {
        return ToothDiseaseEnum::getText($this->disease);
    }

    /**
     * Returns register date as a formatted string.
     *
     * @return string
     */
    public function getRegisterDate() {
        return $this->register_date->translatedFormat("d M Y");
    }
}
