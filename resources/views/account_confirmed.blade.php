@extends('layouts.app')
@section('content')
<div class="ui container">
    @if ($status == "failure")
        <div class="ui visible error message">
            <div class="header">
                Verificación no realizada
            </div>
            Este token de verificación es inválido.
        </div>
    @else
        @if ($status == "verified")
            <div class="ui visible warning message">
                <div class="header">
                    Cuenta ya confirmada
                </div>
                Esta cuenta ya fue confirmada.
                <br>
                <a href="{{ route("account_management") }}" class="ui primary labeled icon button">
                    <i class="cart icon"></i>
                    Ir al Panel de Administración de la cuenta
                </a>
            </div>
        @else
            <div class="ui visible success message">
                <div class="header">
                    ¡Cuenta confirmada!
                </div>
                <br>
                <a href="{{ route("account_management") }}" class="ui primary labeled icon button">
                    <i class="cart icon"></i>
                    Ir al Panel de Administración de la cuenta
                </a>
            </div>
        @endif
    @endif
</div>
@endsection
