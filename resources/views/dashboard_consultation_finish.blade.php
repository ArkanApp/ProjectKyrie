<script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
<script>
    $(document).ready(function () {
        window.hashArguments[0] = "{{ $patient->patient_id }}";
        window.menuRecord("show");
        $("#consultation_date_hour_selector_calendar").calendar({
            monthFirst: false,
            minDate: new Date(),
            onChange: function (date, text) {
                if (date !== undefined && text.length > 0) {
                    $("input[name=consultation_date_format]").val(date.toISOString());
                }
                if (text.length == 0) {
                    $("input[name=consultation_date_format]").val("");
                }
            },
            onSelect: function (date, mode) {
                $("input[name=consultation_date_format]").val(date.toISOString());
            }
        });
        $(".ui.accordion").accordion({
            exclusive: false
        });
    });
</script>
<div class="dashboard_page_header">
    <h2 class="ui dividing header">
        @lang("dashboard.register_consultation")
        <div class="sub header">{{ __("dashboard.for_name", ["full_name" => $patient->getFullName()]) }}</div>
    </h2>
</div>
<br>
<form action="{{ route("dashboard_consultation_finish_save", [
        "patient_id" => $patient->patient_id, 
        "consultation_id" => $consultation->consultation_id
    ]) }}" class="finish_consultation_form ui form" method="POST">
    @csrf
    <div class="required six wide field">
        <label>@lang("dashboard.duration")</label>
        <div class="ui right labeled input">
            <input type="text" name="duration" value="{{ $duration }}" autocomplete="off" required/>
            <div class="ui basic label">@lang("dashboard.minutes")</div>
        </div>
    </div>
    <div class="optional field">
        <label>@lang("dashboard.observations")</label>
        <textarea name="observations" rows="3" maxlength="65535"></textarea>
    </div>
    <div class="ui styled fluid accordion">
        <div class="title">
            <i class="plus icon"></i>
            @lang("dashboard.add_new_prescription")
        </div>
        <div class="content">
            <p class="transition hidden">
                <div class="optional field">
                    <label>@lang("dashboard.prescription_content")</label>
                    <textarea name="prescription_content" rows="5" maxlength="65535"></textarea>
                </div>
            </p>
        </div>
        <div class="title">
            <i class="plus icon"></i>
            @lang("dashboard.add_new_evolution_note")
        </div>
        <div class="content">
            <p class="transition hidden">
                <div class="optional field">
                    <label>@lang("dashboard.evolution_note")</label>
                    <textarea name="evolution_note_note" rows="3" maxlength="255"></textarea>
                </div>
                <div class="ui blue segment">
                    <h3 class="ui dividing header">@lang("dashboard.add_next_consultation")</h3>
                    <div class="optional field">
                        <div class="optional field">
                            <label>@lang("dashboard.consultation_date_and_hour")</label>
                            <div class="ui calendar" id="consultation_date_hour_selector_calendar">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input class="consultation_date" type="text" placeholder="@lang("dashboard.consultation_date_and_hour")" autocomplete="off"/>
                                </div>
                            </div>
                            <input type="hidden" name="consultation_date_format"/>
                        </div>
                        <div class="optional field">
                            <label>@lang("dashboard.treatment")</label>
                            <textarea name="treatment" rows="3" maxlength="65535"></textarea>
                        </div>
                    </div>
                </div>
            </p>
        </div>
    </div>
    <br>
    <div class="optional six wide field">
        <label>@lang("dashboard.cost")</label>
        <div class="ui labeled input">
            <label class="ui label">$</label>
            <input type="text" name="cost" autocomplete="off"/>
        </div>
    </div>
    <div class="ui error message"></div>
    <button class="ui green right floated labeled icon button" type="submit" onclick="saveChanges(this, false);">
        <i class="check icon"></i>
        @lang("dashboard.finish")
    </button>
</form>
