<?php

namespace App\Http\Middleware;

use App\Enums\SubscriptionStatus;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSubscription {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $subscription = Auth::user()->getCurrentSubscription();
        if ($subscription == null || $subscription->status != SubscriptionStatus::ACTIVE) {
            return redirect()->route("account_management");
        }
        return $next($request);
    }
}
