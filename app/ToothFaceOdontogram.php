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

use App\ToothFaceDisease;
use App\Enums\ToothFaceDisease as ToothFaceDiseaseEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ToothFaceOdontogram extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "tooth_face_odontogram";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "tooth_face_odontogram_id";

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
        "tooth_face_odontogram_id" => "integer",
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
     * Returns all ToothFaceDiseases from this tooth.
     *
     * @return array array of ToothFaceDisease
     */
    public function getToothFaceDiseases() {
        return ToothFaceDisease::where("tooth_face_odontogram_id", $this->tooth_face_odontogram_id)
            ->orderBy("tooth_face_disease_id", "desc")->get();
    }

    /**
     * Returns an array of string with all tooth faces where exists at least
     * one ToothFaceDisease.
     * 
     * Faces: top, right, bottom, left, center
     *
     * @return array array of string
     */
    public function getFacesWithDiseases() {
        $faces = [];
        $toothFaceDiseases = ToothFaceDisease::where(
            "tooth_face_odontogram_id", $this->tooth_face_odontogram_id
        )->select([
            "face_vestibular", 
            "face_lingual", 
            "face_distal", 
            "face_mesial", 
            "face_occlusal", 
            "face_cervical",
            "face_palatine"
        ])->get();
        foreach ($toothFaceDiseases as $toothFaceDisease) {
            if (in_array("top", $faces) && in_array("left", $faces) &&
                in_array("bottom", $faces) && in_array("right", $faces) &&
                in_array("center", $faces)
            ) {
                break;
            }
            if (($this->tooth_number >= 11 && $this->tooth_number <= 28) || ($this->tooth_number >= 51 && $this->tooth_number <= 65)) { // upper side
                if ($toothFaceDisease->face_vestibular) {
                    $faces[] = "top";
                }
                if ($toothFaceDisease->face_palatine) {
                    $faces[] = "bottom";
                }
            } elseif (($this->tooth_number >= 31 && $this->tooth_number <= 48) || ($this->tooth_number >= 71 && $this->tooth_number <= 85)) { // bottom side
                if ($toothFaceDisease->face_lingual) {
                    $faces[] = "top";
                }
                if ($toothFaceDisease->face_vestibular) {
                    $faces[] = "bottom";
                }
            }
            if ($toothFaceDisease->face_distal) {
                $faces[] = "left";
            }
            if ($toothFaceDisease->face_mesial) {
                $faces[] = "right";
            }
            if ($toothFaceDisease->face_occlusal) {
                $faces[] = "center";
            }
        }
        return $faces;
    }

    /**
     * Registers a new ToothFaceDisease.
     *
     * @param array $toothFaces [top, right, bottom, left, center, cervical]
     * @param integer $toothFaceDiseaseId
     * @return boolean
     */
    public function registerDisease(array $toothFaces, int $toothFaceDiseaseId) {
        if (!array_key_exists($toothFaceDiseaseId, ToothFaceDiseaseEnum::$diseases)) {
            return false;
        }
        $toothFaceDisease = new ToothFaceDisease();
        $toothFaceDisease->tooth_face_odontogram_id = $this->tooth_face_odontogram_id;
        $toothFaceDisease->register_date = date("Y-m-d", time());
        $toothFaceDisease->disease = $toothFaceDiseaseId;
        $faceSelected = false;
        foreach ($toothFaces as $toothFace) {
            switch ($toothFace) {
                case "top":
                    if (($this->tooth_number >= 11 && $this->tooth_number <= 28) || ($this->tooth_number >= 51 && $this->tooth_number <= 65)) { // upper side
                        $toothFaceDisease->face_vestibular = true;
                    } elseif (($this->tooth_number >= 31 && $this->tooth_number <= 48) || ($this->tooth_number >= 71 && $this->tooth_number <= 85)) { // bottom side
                        $toothFaceDisease->face_lingual = true;
                    }
                    $faceSelected = true;
                    break;
                case "left":
                    $toothFaceDisease->face_distal = true;
                    $faceSelected = true;
                    break;
                case "bottom":
                    if (($this->tooth_number >= 11 && $this->tooth_number <= 28) || ($this->tooth_number >= 51 && $this->tooth_number <= 65)) { // upper side
                        $toothFaceDisease->face_palatine = true;
                    } elseif (($this->tooth_number >= 31 && $this->tooth_number <= 48) || ($this->tooth_number >= 71 && $this->tooth_number <= 85)) { // bottom side
                        $toothFaceDisease->face_vestibular = true;
                    }
                    $faceSelected = true;
                    break;
                case "right":
                    $toothFaceDisease->face_mesial = true;
                    $faceSelected = true;
                    break;
                case "center":
                    $toothFaceDisease->face_occlusal = true;
                    $faceSelected = true;
                    break;
                case "cervical":
                    $toothFaceDisease->face_cervical = true;
                    $faceSelected = true;
                    break;
            }
        }
        if (!$faceSelected) {
            return false;
        }
        try {
            DB::beginTransaction();
            $toothFaceDisease->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
        return true;
    }
}
