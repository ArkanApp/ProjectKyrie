<script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
<script>
    $(document).ready(function () {
        window.hashArguments[0] = "{{ $patient->patient_id }}";
        window.menuRecord("show");
    });
</script>
<div class="dashboard_page_header">
    <h2 class="ui dividing header">
        @lang("dashboard.register_consultation")
        <div class="sub header">{{ __("dashboard.for_name", ["full_name" => $patient->getFullName()]) }}</div>
    </h2>
</div>
<br>
<form action="{{ route("dashboard_register_consultation_save", ["patient_id" => $patient->patient_id]) }}" class="register_consultation_form ui form" method="POST">
    <script>
        $(document).ready(function () {
            $("#consultation_date_hour_selector_calendar").calendar({
                monthFirst: false,
                minDate: new Date(),
                onChange: function (date, text) {
                    if (date !== undefined) {
                        $("input[name=consultation_date_format]").val(date.toISOString());
                    }
                }
            });
        });
    </script>
    @csrf
    <div class="required field">
        <label>@lang("dashboard.consultation_date_and_hour")</label>
        <div class="ui calendar" id="consultation_date_hour_selector_calendar">
            <div class="ui input left icon">
                <i class="calendar icon"></i>
                <input type="text" name="consultation_date" placeholder="@lang("dashboard.consultation_date_and_hour")" autocomplete="off" required/>
            </div>
        </div>
        <input type="hidden" name="consultation_date_format"/>
    </div>
    <div class="required field">
        <label>@lang("dashboard.treatment")</label>
        <textarea name="treatment" rows="3" maxlength="65535"></textarea>
    </div>
    <div class="ui error message"></div>
    <button class="ui green right floated button" type="submit" onclick="saveChanges(this, false);">@lang("dashboard.register")</button>
</form>
