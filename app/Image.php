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

use App\Tools\Tools;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "image";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "image_id";

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
        "image_id" => "integer",
        "patient_id" => "integer",
    ];

    /**
     * The attributes that must be casted to date type.
     *
     * @var array
     */
    protected $dates = [
        "upload_date"
    ];

    /**
     * Returns the URL of this Image.
     *
     * @return string
     */
    public function getPictureUrl() {
        return route("private_images_manager_picture_file", [
            "disk" => "patientImages", 
            "fileName" => $this->file_name
        ]);
    }

    /**
     * Returns a formatted upload date string.
     *
     * @return string
     */
    public function getUploadDate() {
        return Tools::convertDateToFormattedString($this->upload_date);
    }
}
