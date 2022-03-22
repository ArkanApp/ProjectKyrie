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

class Subscription extends Model {
    /**
     * Table in database.
     *
     * @var string
     */
    protected $table = "subscription";

    /**
     * Primary key in table.
     *
     * @var string
     */
    protected $primaryKey = "subscription_id";

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
        "transaction_id",
        "payment_reference"
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "subscription_id" => "integer",
        "account_id" => "integer",
        "type" => "integer",
        "cost" => "float",
        "payment_method" => "integer"
    ];

    /**
     * The attributes that must be casted to date type.
     *
     * @var array
     */
    protected $dates = [
        "end_date",
        "payment_date",
        "purchase_date",
    ];

    /**
     * Returns a formatted end date string.
     *
     * @return string
     */
    public function getEndDate() {
        return Tools::convertDateToFormattedString($this->end_date);
    }

    /**
     * Returns a formatted payment date string.
     *
     * @return string
     */
    public function getPaymentDate() {
        return $this->payment_date != null ? Tools::convertDateTimeToFormattedString($this->payment_date) : "Aún no se ha efectuado el pago";
    }

    /**
     * Returns a formatted purchase date string.
     *
     * @return string
     */
    public function getPurchaseDate() {
        return Tools::convertDateToFormattedString($this->purchase_date);
    }
}
