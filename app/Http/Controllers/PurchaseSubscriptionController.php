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

namespace App\Http\Controllers;

use App\Subscription;
use App\Enums\PaymentMethod;
use App\Enums\SubscriptionStatus;
use App\Enums\SubscriptionType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PurchaseSubscriptionController extends Controller {
    /**
     * Creates a new instance.
     */
    public function __construct() {
        $this->middleware("auth");
    }

    /**
     * Returns step one view.
     *
     * @return View
     */
    public function indexStepOne() {
        $account = Auth::user();
        if ($account->hasAnActiveSubscription()) {
            return redirect()->route("account_management");
        }
        return view("purchase_subscription.step_one", [
            "account" => $account
        ]);
    }

    /**
     * Returns step two view.
     *
     * @param int $subscription_type_id
     * @return View
     */
    public function indexStepTwo(int $subscription_type_id) {
        $subTypeData = SubscriptionType::$typesData[$subscription_type_id];
        if (!$subTypeData || !$subTypeData["isActive"] || ($subTypeData["isForStudents"] && !$account->is_student)) {
            return redirect()->route("purchase_subscription.step_one");
        }
        $account = Auth::user();
        if ($account->hasAnActiveSubscription()) {
            return redirect()->route("account_management");
        }
        return view("purchase_subscription.step_two", [
            "account" => $account,
            "subscriptionTypeId" => $subscription_type_id
        ]);
    }

    /**
     * Returns step three view.
     *
     * @param int $subscription_type_id
     * @param int $payment_method_id
     * @return View
     */
    public function indexStepThree(int $subscription_type_id, int $payment_method_id) {
        $subTypeData = SubscriptionType::$typesData[$subscription_type_id];
        if (!$subTypeData || !$subTypeData["isActive"] || 
            ($subTypeData["isForStudents"] && !$account->is_student) || 
            !PaymentMethod::$methods[$payment_method_id]
        ) {
            return redirect()->route("purchase_subscription.step_one");
        }
        $account = Auth::user();
        if ($account->hasAnActiveSubscription()) {
            return redirect()->route("account_management");
        }
        return view("purchase_subscription.step_three", [
            "account" => $account,
            "subscriptionTypeId" => $subscription_type_id,
            "paymentMethodId" => $payment_method_id
        ]);
    }

    /**
     * Returns step four view.
     *
     * @param int $subscription_type_id
     * @param int $payment_method_id
     * @return View
     */
    public function indexStepFour(int $subscription_type_id, int $payment_method_id) {
        $subTypeData = SubscriptionType::$typesData[$subscription_type_id];
        if (!$subTypeData || !$subTypeData["isActive"] || 
            ($subTypeData["isForStudents"] && !$account->is_student) || 
            !PaymentMethod::$methods[$payment_method_id]
        ) {
            return redirect()->route("purchase_subscription.step_one");
        }
        $account = Auth::user();
        if (!$account->hasAnActiveSubscription()) {
            return redirect()->route("account_management");
        }
        return view("purchase_subscription.step_four", [
            "account" => $account,
            "subscription" => $account->getCurrentSubscription(),
            "subscriptionTypeId" => $subscription_type_id,
            "paymentMethodId" => $payment_method_id
        ]);
    }

    /**
     * Attempts to validate a payment and register a new subscription.
     *
     * @param integer $subscription_type_id
     * @param integer $payment_method_id
     * @param Request $request
     * @return string
     */
    public function pay(int $subscription_type_id, int $payment_method_id, Request $request) {
        $subType = SubscriptionType::$typesData[$subscription_type_id];
        $paymentMethod = PaymentMethod::$methods[$payment_method_id];
        if (!$subType || !$subType["isActive"] || 
            ($subType["isForStudents"] && !$account->is_student) ||
            !$paymentMethod
        ) {
            return response()->json(["status" => "failure", "redirection" => ""]);
        }
        $account = Auth::user();
        if ($account->hasAnActiveSubscription()) {
            return response()->json(["status" => "failure", "redirection" => "", "errors" => "Already active subscription."]);
        }
        $subscription = new Subscription();
        $subscription->account_id = $account->account_id;
        $subscription->purchase_date = date("Y-m-d", time());
        $subscription->payment_method = $payment_method_id;
        $subscription->type = $subscription_type_id;
        $subscription->cost = $subType["price"];
        $subscription->end_date = Carbon::now()->addMonths($subType["months"]);
        if ($payment_method_id == PaymentMethod::PAYPAL_OR_CARD) {
            if (!$this->validatePayment($request->input("orderId"), $subType["price"])) {
                return response()->json(["status" => "failure", "redirection" => "", "errors" => "Invalid payment."]);
            }
            if (Subscription::where("transaction_id", $request->input("orderId")->count() > 0)) {
                return response()->json(["status" => "failure", "redirection" => "", "errors" => "Order ID already in use."]);
            }
            $subscription->payment_reference = $request->input("payerEmail");
            $subscription->transaction_id = $request->input("orderId");
            $subscription->payment_date = date("Y-m-d", time());
            $subscription->status = SubscriptionStatus::ACTIVE;
        } elseif ($payment_method_id == PaymentMethod::BANK) {
            $subscription->payment_reference = substr(strval(time() * rand(100000, 999999)), 0, 8);
            $subscription->status = SubscriptionStatus::PENDING_PAYMENT;
        }
        try {
            DB::beginTransaction();
            $subscription->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(["status" => "failure", "redirection" => "", "errors" => $exception->getMessage()]);
        }
        return response()->json([
            "status" => "success", 
            "redirection" => "/purchaseSubscription/$subscription_type_id/$payment_method_id/paymentDetails"
        ]);
    }

    /**
     * Validates with PayPal API whether this order ID exists.
     *
     * @param string $orderId
     * @param float $price
     * @return boolean
     */
    private function validatePayment($orderId, $price) {
        $ppClientId = config("paypal.sandbox_active") ? config("paypal.sandbox_client_id") : config("paypal.live_client_id");
        $ppSecret = config("paypal.sandbox_active") ? config("paypal.sandbox_secret") : config("paypal.live_secret");
        $ppTokenApiUrl = config("paypal.sandbox_active") ? "https://api.sandbox.paypal.com/v1/oauth2/token" : "https://api.paypal.com/v1/oauth2/token";
        
        $accessTokenResponse = Http::withHeaders([
            "Accept" => "application/json",
            "Accept-Language" => "en_US"
        ])->withBasicAuth($ppClientId, $ppSecret)->asForm()->post($ppTokenApiUrl, [
            "grant_type" => "client_credentials"
        ]);
        if ($accessTokenResponse->failed()) {
            return false;
        }
        $accessToken = $accessTokenResponse->json()["access_token"];

        $ppOrdersApiUrl = config("paypal.sandbox_active") ? "https://api.sandbox.paypal.com/v2/checkout/orders/" : "https://api.paypal.com/v2/checkout/orders/";
        $orderDetails = Http::withToken($accessToken)->get($ppOrdersApiUrl . $orderId);
        if ($orderDetails->failed()) {
            return false;
        }
        $orderJson = $orderDetails->json();
        return $orderJson["status"] == "COMPLETED" && $orderJson["purchase_units"][0]["amount"]["value"] == $price;
    }
}
