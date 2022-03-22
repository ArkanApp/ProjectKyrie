@extends('layouts.app')
@php
    use App\Enums\PaymentMethod;
    use App\Enums\SubscriptionType;
    $ppClientId = config("paypal.sandbox_active") ? config("paypal.sandbox_client_id") : config("paypal.live_client_id");
@endphp
@section('content')
<div class="app_page ui container">
    <h2 class="ui header">Comprar suscripción</h2>
    <div class="ui three top steps">
        <div class="completed step">
            <i class="hand pointer outline icon"></i>
            <div class="content">
                <div class="title">Tipo de suscripción</div>
                <div class="description">Elige tu suscripción</div>
            </div>
        </div>
        <div class="completed step">
            <i class="payment icon"></i>
            <div class="content">
                <div class="title">Método de pago</div>
                <div class="description">Elige tu método de pago</div>
            </div>
        </div>
        <div class="active step">
            <i class="money bill wave icon"></i>
            <div class="content">
                <div class="title">Pago</div>
                <div class="description">Realiza el pago</div>
            </div>
        </div>
    </div>
    @switch($paymentMethodId)
        @case(PaymentMethod::PAYPAL_OR_CARD)
            <script src="https://www.paypal.com/sdk/js?currency=MXN&client-id={{ $ppClientId }}"></script>
            <script>
                paypal.Buttons({
                    createOrder: function (data, actions) {
                        return actions.order.create({
                            application_context: {
                                brand_name: "Project Kyrie",
                                description: "Suscripción de {{ SubscriptionType::$typesData[$subscriptionTypeId]['duration'] }} en Project Kyrie",
                                user_action: "PAY_NOW",
                                shipping_preference: 'NO_SHIPPING',
                            },
                            purchase_units: [{
                                amount: {
                                    value: "{{ SubscriptionType::$typesData[$subscriptionTypeId]['price'] }}",
                                    currency_code: "MXN"
                                }
                            }]
                        });
                    },
                    onApprove: function (data, actions) {
                        return actions.order.capture().then(function (details) {
                            if (details.status == "COMPLETED") {
                                $.ajax({
                                    type: "POST",
                                    url: window.location.href + "/pay",
                                    data: {
                                        orderId: details.id,
                                        status: details.status,
                                        payerEmail: details.payer.email_address
                                    },
                                    success: function (response) {
                                        if (response && response["status"] == "success") {
                                            window.location.href = response["redirection"];
                                        } else {
                                            $(".ui.error.message").html("Ocurrió un error al registrar la suscripción. Por favor, comunícate con nosotros.");
                                            $(".ui.error.message").css("display", "block");
                                        }
                                    }
                                });
                            }
                        })
                    }
                }).render('#paypal_buttons');
            </script>
            <div class="ui center aligned segment">
                <div id="paypal_buttons"></div>
                <div class="ui error message" style="display:none;"></div>
            </div>
            @break
        @case(PaymentMethod::BANK)
            @php
                $subType = SubscriptionType::$typesData[$subscriptionTypeId];
            @endphp
            <div class="ui blue segment">
                Estás por solicitar una suscripción de {{ $subType["duration"] }}
                por {{ App\Tools\Tools::convertToMoney($subType["price"]) }}, ¿desea continuar?<br>
                En la siguiente página se le mostrará los datos de la cuenta y un número de referencia con el
                que se identificará su suscripción.<br><br>
                <form action="{{ route("purchase_subscription.pay", [
                    "subscription_type_id" => $subscriptionTypeId, 
                    "payment_method_id" => $paymentMethodId
                ]) }}" method="POST">
                    <div class="ui primary labeled icon button" onclick="saveChanges(this, false);">
                        <i class="right arrow icon"></i>
                        Solicitar suscripción
                    </div>
                </form>
            </div>
            @break
        @default
    @endswitch
</div>
@endsection
