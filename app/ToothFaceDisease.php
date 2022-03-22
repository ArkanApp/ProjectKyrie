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

use App\Enums\ToothFaceDisease as ToothFaceDiseaseEnum;
use Illuminate\Database\Eloquent\Model;

class ToothFaceDisease extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "tooth_face_disease";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "tooth_face_disease_id";

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
        "tooth_face_disease_id" => "integer",
        "tooth_face_odontogram_id" => "integer",
        "face_vestibular" => "boolean",
        "face_lingual" => "boolean",
        "face_distal" => "boolean",
        "face_mesial" => "boolean",
        "face_occlusal" => "boolean",
        "face_cervical" => "boolean",
        "face_palatine" => "boolean",
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
     * Returns all faces affected by this disease.
     *
     * @return array array of string
     */
    public function getFaces() {
        $faces = [];
        if ($this->face_vestibular) {
            $faces[] = __("tooth_face.vestibular");
        }
        if ($this->face_lingual) {
            $faces[] = __("tooth_face.lingual");
        }
        if ($this->face_distal) {
            $faces[] = __("tooth_face.distal");
        }
        if ($this->face_mesial) {
            $faces[] = __("tooth_face.mesial");
        }
        if ($this->face_occlusal) {
            $faces[] = __("tooth_face.occlusal");
        }
        if ($this->face_cervical) {
            $faces[] = __("tooth_face.cervical");
        }
        if ($this->face_palatine) {
            $faces[] = __("tooth_face.palatine");
        }
        return $faces;
    }

    /**
     * Returns disease name.
     *
     * @return string
     */
    public function getDisease() {
        return ToothFaceDiseaseEnum::getText($this->disease);
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
