<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Project Kyrie') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('css/app.css') }}?v=1.0" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.6/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.6/dist/semantic.min.js"></script>
    <script src="{{ asset('js/system.min.js') }}?v=1.0"></script>
    <script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
</head>
<body>
    <div class="app">
        <div class="top_bar">
            <a class="logo_header" href="{{ route("home") }}">Project Kyrie</a>
            <div class="top_bar_buttons">
                @auth
                    <div class="ui dropdown" id="user_dropdown">
                        <div class="text">¡Hola, {{ Auth::user()->name }}!</div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <a href="{{ route("account_management") }}" class="item">Administración de la cuenta</a>
                            @if (Auth::user()->hasAnActiveSubscription())
                                <a href="{{ route("dashboard") }}" class="item">Ir al portal</a>
                            @endif
                            <div class="divider"></div>
                            <form action="{{ route("logout") }}" method="POST" id="logout_form">@csrf</form>
                            <div class="item" onclick="$('#logout_form').submit();">Cerrar sesión</div>
                        </div>
                    </div>
                @endauth
                @guest
                    <a href="{{ route("login") }}" class="ui inverted compact green button">Ingresar</a>
                    <a href="{{ route("register") }}" class="ui inverted compact primary button">Registrarse</a>
                @endguest
            </div>
        </div>
        <div class="content">
            @yield("content")
        </div>
    </div>
</body>
<footer>
    <div class="ui divider"></div>
    <center>
        Arkan App - {{ date("Y", time()) }}<br>
        <div>
            <a href="https://arkanapp.com">Arkan App</a> |
            <a href="https://www.facebook.com/ArkanApp">Arkan App @ Facebook</a> |
            <a href="{{ route('terms') }}">Términos y Condiciones</a>
        </div>
    </center>
</footer>
</html>
