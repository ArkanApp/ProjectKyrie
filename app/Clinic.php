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

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Clinic extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "clinic";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "clinic_id";

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
        "clinic_id" => "integer",
        "account_id" => "integer",
        "external_number" => "integer",
        "internal_number" => "integer",
        "country" => "integer",
    ];

    /**
     * The attributes that must be casted to date type.
     *
     * @var array
     */
    protected $dates = [
    ];

    /**
     * Returns an URL string to show the picture file.
     *
     * @return string
     */
    public function getPictureFile() {
        if ($this->picture_file == null) {
            return Storage::url("clinics/pictureFiles/default.png");
        }
        return route("private_images_manager_picture_file", [
            "disk" => "clinicPictureFiles", 
            "fileName" => $this->picture_file
        ]);
    }
}
