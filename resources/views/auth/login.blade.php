@extends('layouts.app')

@section('content')
<div class="auth_content ui container">
    <br>
    <div class="ui clearing segment">
        <h2 class="ui header">@lang("auth.login")</h2>
        <form class="auth_form ui form" action="{{ route("login") }}" method="POST">
            @csrf
            <div class="field">
                <label>@lang("auth.email")</label>
                <input type="email" name="email" placeholder="@lang("auth.email")" autocomplete="off">
            </div>
            <div class="field">
                <label>@lang("auth.password")</label>
                <input type="password" name="password" placeholder="@lang("auth.password")">
            </div>
            <button class="ui right floated primary button" type="submit">@lang("auth.login")</button>
            <a class="ui right floated small button" href="{{ route("register") }}">@lang("auth.sign_up")</a>
        </form>
    </div>
</div>
@endsection
