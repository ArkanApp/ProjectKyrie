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

class ClinicalRecordFieldValue extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "clinical_record_field_value";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "clinical_record_field_value_id";

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
        "clinical_record_field_value_id" => "integer",
        "clinical_record_field_id" => "integer",
        "patient_id" => "integer"
    ];

    /**
     * The attributes that must be casted to date type.
     *
     * @var array
     */
    protected $dates = [
    ];
}
