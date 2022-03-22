<script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
<script>
    $(document).ready(function () {
        window.changeMenuActiveButton("#profile_button");
    });
</script>
<div class="dashboard_page_header">
    <h2 class="ui dividing header">@lang("dashboard.modify_clinic_data")</h2>
</div>
<br>
<form action="{{ route("dashboard_modify_clinic_save") }}" class="modify_clinic_form ui form" method="POST">
    @csrf
    <div class="required field">
        <label>@lang("dashboard.name")</label>
        <input type="text" name="name" placeholder="@lang("dashboard.name")" maxlength="255" autocomplete="off" value="{{ $clinic->name }}" required>
    </div>
    <div class="required field">
        <label>@lang("dashboard.phone")</label>
        <input type="text" name="phone" placeholder="@lang("dashboard.phone")" maxlength="15" autocomplete="off" value="{{ $clinic->phone }}" required>
    </div>
    <h4 class="ui dividing header">Dirección</h4>
    <div class="required field">
        <label>@lang("dashboard.country")</label>
        <div class="ui selection dropdown" id="country_dropdown">
            <input type="hidden" name="country" value="{{ $clinic->country }}" required/>
            <i class="dropdown icon"></i>
            <div class="default text">@lang("dashboard.country")</div>
            <div class="menu">
                @foreach (App\Enums\Country::$countries as $countryId => $countryName)
                    <div class="{{ $countryId == $clinic->country ? "active " : "" }}item" data-value="{{ $countryId }}">
                        {{ App\Enums\Country::getText($countryId) }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="required field">
        <label>@lang("dashboard.street1")</label>
        <input type="text" name="street1" placeholder="@lang("dashboard.street1")" maxlength="255" autocomplete="off" value="{{ $clinic->street1 }}" required>
    </div>
    <div class="three fields">
        <div class="required field">
            <label>@lang("dashboard.external_number")</label>
            <input type="text" name="external_number" placeholder="@lang("dashboard.external_number")" maxlength="11" autocomplete="off" value="{{ $clinic->external_number }}" required>
        </div>
        <div class="optional field">
            <label>@lang("dashboard.internal_number")</label>
            <input type="text" name="internal_number" placeholder="@lang("dashboard.internal_number")" maxlength="11" autocomplete="off" value="{{ $clinic->internal_number }}">
        </div>
        <div class="required field">
            <label>@lang("dashboard.colony")</label>
            <input type="text" name="colony" placeholder="@lang("dashboard.colony")" maxlength="255" autocomplete="off" value="{{ $clinic->colony }}" required>
        </div>
    </div>
    <div class="three fields">
        <div class="required field">
            <label>@lang("dashboard.municipality")</label>
            <input type="text" name="municipality" placeholder="@lang("dashboard.municipality")" maxlength="255" autocomplete="off" value="{{ $clinic->municipality }}" required>
        </div>
        <div class="required field">
            <label>@lang("dashboard.state")</label>
            <input type="text" name="state" placeholder="@lang("dashboard.state")" maxlength="255" autocomplete="off" value="{{ $clinic->state }}" required>
        </div>
        <div class="required field">
            <label>@lang("dashboard.zipcode")</label>
            <input type="text" name="zipcode" placeholder="@lang("dashboard.zipcode")" maxlength="10" autocomplete="off" value="{{ $clinic->zipcode }}" required>
        </div>
    </div>
    <h4 class="ui dividing header">@lang("dashboard.clinic_logo")</h4>
    <div class="optional field">
        <label>@lang("dashboard.image")</label>
        <ul class="ui list">
            <li>@lang("dashboard.image_max_size_constraint")</li>
            <li>@lang("dashboard.image_formats_constraint")</li>
        </ul>
        <input type="file" name="picture_file" accept=".jpg, .jpeg, .png" required/>
    </div>
    <div class="ui error message"></div>
    <button class="ui green right floated labeled icon button" type="submit" onclick="saveChanges(this, true);">
        <i class="check icon"></i>
        @lang("dashboard.save_changes")
    </button>
</form>
