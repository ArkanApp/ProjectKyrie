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

use App\Consultation;
use Illuminate\Database\Eloquent\Model;

class EvolutionNote extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "evolution_note";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "evolution_note_id";

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
        "evolution_note_id" => "integer",
        "next_consultation_id" => "integer",
    ];

    /**
     * The attributes that must be casted to date type.
     *
     * @var array
     */
    protected $dates = [
    ];

    /**
     * Returns the Consultation that has this EvolutionNote.
     *
     * @return Consultation
     */
    public function getConsultation() {
        return Consultation::where("evolution_note_id", $this->evolution_note_id)->get()->first();
    }

    /**
     * Returns the next Consultation attached to this EvolutionNote.
     *
     * @return Consultation
     */
    public function getNextConsultation() {
        if ($this->next_consultation_id == null) {
            return null;
        }
        return Consultation::where("consultation_id", $this->next_consultation_id)->get()->first();
    }
}
