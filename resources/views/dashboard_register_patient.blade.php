<script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
<script>
    $(document).ready(function () {
        window.menuRecord("hide");
    });
</script>
<div class="dashboard_page_header">
    <h2 class="ui dividing header">@lang("dashboard.register_patient")</h2>
</div>
<br>
<form action="{{ route("dashboard_register_patient_save") }}" class="register_patient_form ui form" method="POST" enctype="multipart/form-data">
    <script>
        $(document).ready(function () {
            $("#birthdate_selector_calendar").calendar({
                type: "date",
                monthFirst: false,
                onChange: function (date, text) {
                    const dateFormat = [date.getFullYear(), date.getMonth() + 1, date.getDate()].join("-");
                    $("input[name=birthdate_format]").val(dateFormat);
                }
            });
            $("#gender_dropdown").dropdown();
            $("#civil_status_dropdown").dropdown();
            $("#nationality_dropdown").dropdown();
        });
    </script>
    @csrf
    <div class="two fields">
        <div class="required field">
            <label>@lang("dashboard.name")</label>
            <input type="text" name="name" placeholder="@lang("dashboard.name")" maxlength="100" autocomplete="off" required>
        </div>
        <div class="required field">
            <label>@lang("dashboard.last_name")</label>
            <input type="text" name="last_name" placeholder="@lang("dashboard.last_name")" maxlength="100" autocomplete="off" required>
        </div>
    </div>
    <div class="two fields">
        <div class="required field">
            <label>@lang("dashboard.birthdate")</label>
            <div class="ui calendar" id="birthdate_selector_calendar">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" name="birthdate" placeholder="@lang("dashboard.birthdate")" autocomplete="off" required>
                </div>
            </div>
            <input type="hidden" name="birthdate_format"/>
        </div>
        <div class="required field">
            <label>@lang("dashboard.gender")</label>
            <div class="ui selection dropdown" id="gender_dropdown">
                <input type="hidden" name="gender" required>
                <i class="dropdown icon"></i>
                <div class="default text">@lang("dashboard.gender")</div>
                <div class="menu">
                    @foreach ($genders as $genderId => $genderName)
                        <div class="item" data-value="{{ $genderId }}">
                            {{ App\Enums\Gender::getText($genderId) }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="required field">
        <label>@lang("dashboard.occupation")</label>
        <input type="text" name="occupation" placeholder="@lang("dashboard.occupation")" maxlength="255" autocomplete="off" required>
    </div>
    <div class="required field">
        <label>@lang("dashboard.scholarship")</label>
        <input type="text" name="scholarship" placeholder="@lang("dashboard.scholarship")" maxlength="100" autocomplete="off" required>
    </div>
    <div class="two fields">
        <div class="required field">
            <label>@lang("dashboard.civil_status")</label>
            <div class="ui selection dropdown" id="civil_status_dropdown">
                <input type="hidden" name="civil_status" required>
                <i class="dropdown icon"></i>
                <div class="default text">@lang("dashboard.civil_status")</div>
                <div class="menu">
                    @foreach ($civilStatus as $civilStatusId => $civilStatusName)
                        <div class="item" data-value="{{ $civilStatusId }}">
                            {{ App\Enums\CivilStatus::getText($civilStatusId) }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="required field">
            <label>@lang("dashboard.nationality")</label>
            <div class="ui selection dropdown" id="nationality_dropdown">
                <input type="hidden" name="nationality" required>
                <i class="dropdown icon"></i>
                <div class="default text">@lang("dashboard.nationality")</div>
                <div class="menu">
                    @foreach ($nationalities as $nationalityId => $nationalityName)
                        <div class="item" data-value="{{ $nationalityId }}">
                            {{ App\Enums\Nationality::getText($nationalityId) }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="required field">
        <label>@lang("dashboard.email")</label>
        <input type="email" name="email" placeholder="@lang("dashboard.email")" maxlength="255" autocomplete="off" required>
    </div>
    <div class="two fields">
        <div class="required field">
            <label>@lang("dashboard.home_phone")</label>
            <input type="text" name="home_phone" placeholder="@lang("dashboard.home_phone")" maxlength="15" autocomplete="off" required>
        </div>
        <div class="required field">
            <label>@lang("dashboard.cell_phone")</label>
            <input type="text" name="cell_phone" placeholder="@lang("dashboard.cell_phone")" maxlength="15" autocomplete="off" required>
        </div>
    </div>
    <div class="optional field">
        <label>@lang("dashboard.image")</label>
        <ul class="ui list">
            <li>@lang("dashboard.image_max_size_constraint")</li>
            <li>@lang("dashboard.image_formats_constraint")</li>
        </ul>
        <input type="file" name="picture_file" accept=".jpg, .jpeg, .png" required/>
    </div>
    <h4 class="ui dividing header">Dirección</h4>
    <div class="required field">
        <label>@lang("dashboard.street1")</label>
        <input type="text" name="street1" placeholder="@lang("dashboard.street1")" maxlength="255" autocomplete="off" required>
    </div>
    <div class="three fields">
        <div class="required field">
            <label>@lang("dashboard.external_number")</label>
            <input type="text" name="external_number" placeholder="@lang("dashboard.external_number")" maxlength="11" autocomplete="off" required>
        </div>
        <div class="optional field">
            <label>@lang("dashboard.internal_number")</label>
            <input type="text" name="internal_number" placeholder="@lang("dashboard.internal_number")" maxlength="11" autocomplete="off">
        </div>
        <div class="required field">
            <label>@lang("dashboard.colony")</label>
            <input type="text" name="colony" placeholder="@lang("dashboard.colony")" maxlength="255" autocomplete="off" required>
        </div>
    </div>
    <div class="three fields">
        <div class="required field">
            <label>@lang("dashboard.municipality")</label>
            <input type="text" name="municipality" placeholder="@lang("dashboard.municipality")" maxlength="255" autocomplete="off" required>
        </div>
        <div class="required field">
            <label>@lang("dashboard.state")</label>
            <input type="text" name="state" placeholder="@lang("dashboard.state")" maxlength="255" autocomplete="off" required>
        </div>
        <div class="required field">
            <label>@lang("dashboard.zipcode")</label>
            <input type="text" name="zipcode" placeholder="@lang("dashboard.zipcode")" maxlength="10" autocomplete="off" required>
        </div>
    </div>
    <div class="ui error message"></div>
    <button class="ui green right floated button" type="submit" onclick="saveChanges(this, true);">@lang("dashboard.register")</button>
</form>
