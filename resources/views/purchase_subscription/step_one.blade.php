@extends('layouts.app')

@section('content')
<div class="app_page ui container">
    <h2 class="ui header">Comprar suscripción</h2>
    <div class="ui three top steps">
        <div class="active step">
            <i class="hand pointer outline icon"></i>
            <div class="content">
                <div class="title">Tipo de suscripción</div>
                <div class="description">Elige tu suscripción</div>
            </div>
        </div>
        <div class="disabled step">
            <i class="payment icon"></i>
            <div class="content">
                <div class="title">Método de pago</div>
                <div class="description">Elige tu método de pago</div>
            </div>
        </div>
        <div class="disabled step">
            <i class="money bill wave icon"></i>
            <div class="content">
                <div class="title">Pago</div>
                <div class="description">Realiza el pago</div>
            </div>
        </div>
    </div>
    <div class="ui cards">
        @foreach (App\Enums\SubscriptionType::$typesData as $typeId => $typeData)
            @if (!$typeData["isActive"])
                @continue
            @endif
            @if ($typeData["isForStudents"] && !$account->is_student)
                @continue
            @endif
            <div class="card">
                <div class="content">
                    <div class="header">Suscripción de {{ $typeData["duration"] }}</div>
                    <div class="meta">{{ App\Tools\Tools::convertToMoney($typeData["price"]) }}</div>
                </div>
                <div class="extra content">
                    <a href="{{ route("purchase_subscription.step_two", ["subscription_type_id" => $typeId]) }}" class="ui primary fluid labeled icon button">
                        <i class="right arrow icon"></i>
                        Seleccionar
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
