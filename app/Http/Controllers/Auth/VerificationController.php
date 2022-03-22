<?php

namespace App\Http\Controllers\Auth;

use App\Account;
use App\Http\Controllers\Controller;
use App\Mail\AccountCreated;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    /**
     * Attempts to verify an Account which has the given verification token.
     *
     * @param string $verificationToken
     * @return View
     */
    public function verifyAccount(string $verificationToken) {
        $account = Account::where("verification_token", $verificationToken)->get()->first();
        if ($account == null) {
            return view("account_confirmed", ["status" => "failure"]);
        }
        if ($account->verified) {
            return view("account_confirmed", ["status" => "verified"]);
        }
        $account->verified = true;
        $account->save();
        return view("account_confirmed", ["status" => "success"]);
    }

    /**
     * Attempts to resend verification email.
     *
     * @param Request $request
     * @return string
     */
    public function resendVerificationEmail(Request $request) {
        $this->middleware("auth");
        $account = Auth::user();
        Mail::to($account->email)->send(new AccountCreated($account));
        return response()->json(["status" => "success", "redirection" => ""]);
    }
}
