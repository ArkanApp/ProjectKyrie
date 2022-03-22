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

class ClinicalRecordFieldGroup extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "clinical_record_field_group";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "clinical_record_field_group_id";

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
        "clinical_record_field_group_id" => "integer",
        "clinical_record_id" => "integer"
    ];

    /**
     * The attributes that must be casted to date type.
     *
     * @var array
     */
    protected $dates = [
    ];

    /**
     * Returns all fields attached to this group.
     *
     * @return array array of ClinicalRecordField
     */
    public function getFields() {
        return ClinicalRecordField::where(
            "clinical_record_field_group_id", 
            $this->clinical_record_field_group_id
        )->get();
    }
}
