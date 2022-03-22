<div id="loading_modal" class="ui basic modal">
    <div class="ui header">
        @lang("dashboard.loading")
    </div>
    <div class="content">
        <p>@lang("dashboard.loading_message")</p>
    </div>
</div>
@if (!Auth::user()->hasClinic())
    <script>
        $(document).ready(function () {
            $("#startup_modal").modal({
                closable: false
            }).modal("show");
        });
    </script>
    <div id="startup_modal" class="ui modal">
        <div class="ui center aligned header">@lang("dashboard.startup_modal.welcome_message")</div>
        <div class="scrolling content">
            @lang("dashboard.startup_modal.greeting_and_explanation")
            <div class="ui green clearing segment">
                <div class="ui dividing header">
                    @lang("dashboard.startup_modal.set_profile_picture")
                </div>
                <form action="{{ route("dashboard_modify_profile_picture_save") }}" method="POST" class="modify_profile_picture_form ui form">
                    @csrf
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
            </div>
            <div class="ui blue clearing segment">
                <div class="ui dividing header">
                    @lang("dashboard.startup_modal.create_your_clinic")
                </div>
                <form action="{{ route("dashboard_register_clinic_save") }}" method="POST" class="register_clinic_form ui form">
                    @csrf
                    <div class="required field">
                        <label>@lang("dashboard.name")</label>
                        <input type="text" name="name" placeholder="@lang("dashboard.name")" maxlength="255" autocomplete="off" required/>
                    </div>
                    <div class="required field">
                        <label>@lang("dashboard.phone")</label>
                        <input type="text" name="phone" placeholder="@lang("dashboard.phone")" maxlength="15" autocomplete="off" required/>
                    </div>
                    <h4 class="ui dividing header">@lang("dashboard.address")</h4>
                    <div class="required field">
                        <label>@lang("dashboard.country")</label>
                        <div class="ui selection dropdown" id="country_dropdown">
                            <input type="hidden" name="country" required>
                            <i class="dropdown icon"></i>
                            <div class="default text">@lang("dashboard.country")</div>
                            <div class="menu">
                                @foreach (App\Enums\Country::$countries as $countryId => $countryName)
                                    <div class="item" data-value="{{ $countryId }}">
                                        {{ App\Enums\Country::getText($countryId) }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="required field">
                        <label>@lang("dashboard.street1")</label>
                        <input type="text" name="street1" placeholder="@lang("dashboard.street1")" maxlength="255" autocomplete="off" required/>
                    </div>
                    <div class="three fields">
                        <div class="required field">
                            <label>@lang("dashboard.external_number")</label>
                            <input type="text" name="external_number" placeholder="@lang("dashboard.external_number")" maxlength="11" autocomplete="off" required/>
                        </div>
                        <div class="optional field">
                            <label>@lang("dashboard.internal_number")</label>
                            <input type="text" name="internal_number" placeholder="@lang("dashboard.internal_number")" maxlength="11" autocomplete="off""/>
                        </div>
                        <div class="required field">
                            <label>@lang("dashboard.colony")</label>
                            <input type="text" name="colony" placeholder="@lang("dashboard.colony")" maxlength="255" autocomplete="off" required/>
                        </div>
                    </div>
                    <div class="three fields">
                        <div class="required field">
                            <label>@lang("dashboard.municipality")</label>
                            <input type="text" name="municipality" placeholder="@lang("dashboard.municipality")" maxlength="255" autocomplete="off" required/>
                        </div>
                        <div class="required field">
                            <label>@lang("dashboard.state")</label>
                            <input type="text" name="state" placeholder="@lang("dashboard.state")" maxlength="255" autocomplete="off" required/>
                        </div>
                        <div class="required field">
                            <label>@lang("dashboard.zipcode")</label>
                            <input type="text" name="zipcode" placeholder="@lang("dashboard.zipcode")" maxlength="10" autocomplete="off" required/>
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
                        @lang("dashboard.finish")
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif
<div id="consultation_modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">@lang("dashboard.consultation_details")</div>
    <div class="image content">
        <div class="ui medium image">
            <img src="">
        </div>
        <div class="description">
            <div class="consultation_patient_name ui header"></div>
            <div class="ui relaxed divided list">
                <div class="consultation_date item">
                    <i class="large calendar middle aligned icon"></i>
                    <div class="content">
                        <div class="header">@lang("dashboard.date_and_hour")</div>
                        <div class="description"></div>
                    </div>
                </div>
                <div class="consultation_treatment item">
                    <i class="large notes medical middle aligned icon"></i>
                    <div class="content">
                        <div class="header">@lang("dashboard.treatment")</div>
                        <div class="description"></div>
                    </div>
                </div>
                <div class="consultation_status item">
                    <i class="large angle right middle aligned icon"></i>
                    <div class="content">
                        <div class="header">@lang("dashboard.status")</div>
                        <div class="description"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="actions">
        <a id="consult_record" class="ui primary button">
            @lang("dashboard.consult_record")
        </a>
        <div class="ui black deny button">
            @lang("dashboard.close")
        </div>
    </div>
</div>
