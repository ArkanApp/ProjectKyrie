@extends('layouts.app')
@php
    use App\Enums\PaymentMethod;
    use App\Enums\SubscriptionType;
@endphp
@section('content')
<div class="app_page ui container">
    <h2 class="ui header">Comprar suscripción</h2>
    @switch($paymentMethodId)
        @case(PaymentMethod::PAYPAL_OR_CARD)
            <div class="ui center aligned blue segment">
                <h2 class="ui center aligned icon header">
                    <i class="check icon"></i>
                    ¡Compra exitosa!
                </h2>
                ¡Muchas gracias por tu compra! Ya puedes empezar a utilizar Project Kyrie ❤.<br><br>
                <a href="{{ route("dashboard") }}" class="ui primary labeled icon button">
                    <i class="right arrow icon"></i>
                    Ir al portal
                </a>
            </div>
            @break
        @case(PaymentMethod::BANK)
            <div class="ui center aligned blue segment">
                <h2 class="ui center aligned icon header">
                    <i class="check icon"></i>
                    ¡Suscripción solicitada con éxito!
                </h2>
                ¡Muchas gracias por tu solicitud! El siguiente paso es realizar tu pago de acuerdo a la siguiente información:<br>
                <div class="ui bulleted list">
                    <div class="item">
                        <b>Número de cuenta: </b>{{ config("bank.account_number") }}<br>
                    </div>
                    <div class="item">
                        <b>Número de referencia: </b>{{ $subscription->payment_reference }}<br>
                    </div>
                    <div class="item">
                        <b>Banco: </b>{{ config("bank.bank_name") }}<br><br>
                    </div>
                </div>
                En cuanto realices el pago correspondiente, tu suscripción se activará dentro de las próximas 24 horas.<br><br>
                <a href="{{ route("account_management") }}" class="ui primary labeled icon button">
                    <i class="left arrow icon"></i>
                    Volver a la Administración de la cuenta
                </a>
            </div>
            @break
        @default
    @endswitch
</div>
@endsection
