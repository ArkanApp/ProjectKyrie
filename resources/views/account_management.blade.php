@extends('layouts.app')
@php
    use App\Enums\SubscriptionStatus;
    use App\Enums\SubscriptionType;
    use App\Tools\Tools;
    $subscription = $account->getCurrentSubscription();
@endphp
@section('content')
<div class="app_page ui container">
    <h2 class="ui center aligned header">¡Hola, {{ $account->name }}!</h2>
    @if (!$account->verified)
        <div class="ui visible warning message">
            <div class="header">
                Cuenta no verificada
            </div>
            <br>
            Para poder comenzar a utilizar tu cuenta debidamente, necesitas verificarla ingresando al enlace que fue enviado
            a tu correo electrónico. Si no lo encuentras, revisa tu bandeja de correo no deseado (spam). Si no lo recibiste,
            puedes solicitar un reenvío.
            <form action="{{ route("resend_account_verification_mail") }}" method="POST">
                <button class="ui primary labeled icon button" type="submit" onclick="saveChanges(this, false);">
                    <i class="mail icon"></i>
                    Reenviar correo
                </button>
            </form>
        </div>
    @else
        @if ($subscription == null)
            <div class="ui visible warning message">
                <div class="header">
                    ¡Vaya! Parece que no tienes ninguna suscripción activa.
                </div>
            </div>
        @else
            @php
                $statusLabel = "";
                switch ($subscription->status) {
                    case SubscriptionStatus::PENDING_PAYMENT:
                        $statusLabel = "orange";
                        break;
                    case SubscriptionStatus::ACTIVE:
                        $statusLabel = "green";
                        break;
                    case SubscriptionStatus::SUSPENDED:
                        $statusLabel = "yellow";
                        break;
                    case SubscriptionStatus::CANCELLED:
                        $statusLabel = "red";
                        break;
                    case SubscriptionStatus::FINISHED:
                        $statusLabel = "teal";
                        break;
                    default:
                        break;
                }
            @endphp
            <div class="ui attached orange segment">
                <h3 class="ui dividing header">Tu suscripción</h3>
                <div class="ui two columns stackable grid">
                    <div class="column">
                        <b>Tipo: </b>{{ SubscriptionType::$typesData[$subscription->type]["duration"] }}<br>
                        <b>Costo: </b>{{ Tools::convertToMoney($subscription->cost) }}<br>
                        <b>Estado: </b>
                        <a class="ui {{ $statusLabel }} label">
                            {{ SubscriptionStatus::getText($subscription->status) }}
                        </a><br>
                        <br>
                        <b>Fecha de compra: </b>{{ $subscription->getPurchaseDate() }}<br>
                        <b>Fecha de pago: </b>{{ $subscription->getPaymentDate() }}<br>
                        <b>Fecha de finalización: </b>{{ $subscription->getEndDate() }}
                    </div>
                    @if ($subscription->status == SubscriptionStatus::PENDING_PAYMENT)
                        <div class="column">
                            <b>Datos del pago</b>
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
                        </div>
                    @endif
                </div>
            </div>
            @if ($subscription->status == SubscriptionStatus::ACTIVE)
                <a href="{{ route('dashboard') }}" class="ui bottom attached primary labeled icon button">
                    <i class="right angle icon"></i>
                    Ir al portal
                </a>
            @endif
        @endif
    @endif
</div>
@endsection
