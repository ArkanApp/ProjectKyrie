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

namespace App\Http\Controllers\Auth;

use App\Account;
use App\Subscription;
use App\Enums\SubscriptionStatus;
use App\Enums\SubscriptionType;
use App\Http\Controllers\Controller;
use App\Mail\AccountCreated;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ACCOUNT_MANAGEMENT;

    /**
     * Student email domains.
     *
     * @var array
     */
    private static $studentEmailDomains = [
        "estudiantes.uv.mx"
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            "name" => ["required", "string", "max:100"],
            "last_name" => ["required", "string", "max:100"],
            "email" => ["required", "string", "email", "max:255", "unique:account"],
            "password" => ["required", "string", "min:8", "confirmed"],
            "area" => ["required", "integer"],
            "terms" => ["required", "starts_with:on"]
        ]);
    }

    /**
     * Create a new account instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Account
     */
    protected function create(array $data) {
        $newAccount = new Account();
        $newAccount->name = $data["name"];
        $newAccount->last_name = $data["last_name"];
        $newAccount->email = $data["email"];
        $newAccount->password = Hash::make($data["password"]);
        $newAccount->area_id = $data["area"];
        $newAccount->register_date = date("Y-m-d", time());
        $newAccount->verified = true;
        $newAccount->verification_token = hash("sha512", \uniqid(time()));
        $newAccount->is_student = false;
        $newAccount->save();
        $subTypeId = SubscriptionType::FOREVER;
        $subType = SubscriptionType::$typesData[$subTypeId];
        $subscription = new Subscription();
        $subscription->account_id = $newAccount->account_id;
        $subscription->purchase_date = date("Y-m-d", time());
        $subscription->payment_method = 0;
        $subscription->type = $subTypeId;
        $subscription->cost = $subType["price"];
        $subscription->end_date = "2100-01-01";
        $subscription->payment_reference = $data["email"];
        $subscription->transaction_id = null;
        $subscription->payment_date = date("Y-m-d h:i", time());
        $subscription->status = SubscriptionStatus::ACTIVE;
        $subscription->save();
        return $newAccount;
    }
}
