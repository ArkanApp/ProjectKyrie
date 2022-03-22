@extends('layouts.app')

@section('content')
<div class="auth_content ui container">
    <br>
    <div class="ui clearing segment">
        <h2 class="ui header">@lang("auth.sign_up")</h2>
        <form class="auth_form ui form" action="{{ route("register") }}" method="POST">
            @csrf
            <div class="two fields">
                <div class="required field">
                    <label>@lang("auth.name")</label>
                    <input type="text" name="name" placeholder="@lang("auth.name")" autocomplete="off" required/>
                </div>
                <div class="required field">
                    <label>@lang("auth.last_name")</label>
                    <input type="text" name="last_name" placeholder="@lang("auth.last_name")" autocomplete="off" required/>
                </div>
            </div>
            <div class="required field">
                <label>@lang("auth.email")</label>
                <input type="email" name="email" placeholder="@lang("auth.email")" autocomplete="off" required/>
            </div>
            <div class="two fields">
                <div class="required field">
                    <label>@lang("auth.password")</label>
                    <input type="password" name="password" placeholder="@lang("auth.password")" required/>
                </div>
                <div class="required field">
                    <label>@lang("auth.password_confirmation")</label>
                    <input type="password" name="password_confirmation" placeholder="@lang("auth.password_confirmation")" required/>
                </div>
            </div>
            <div class="required field">
                <label>@lang("auth.area_label")</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="area" required/>
                    <i class="dropdown icon"></i>
                    <div class="default text">@lang("auth.area")</div>
                    <div class="menu">
                        @foreach (App\Area::all() as $area)
                            <div class="item" data-value="{{ $area->area_id }}">{{ $area->name }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="inline required field">
                <div class="ui toggle checkbox">
                    <input type="checkbox" name="terms" class="hidden" required/>
                    <label>Acepto los <a href="{{ route('terms') }}" target="_blank">términos y condiciones</a></label>
                </div>
            </div>
            <button class="ui right floated primary button" type="submit">@lang("auth.sign_up")</button>
        </form>
    </div>
</div>
@endsection
