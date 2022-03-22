<script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
<script>
    $(document).ready(function () {
        window.hashArguments[0] = "{{ $patient->patient_id }}";
        window.menuRecord("show");
        window.changeMenuActiveButton("#clinical_records_button");
        $(".ui.dropdown").dropdown();
    });
</script>
<div class="dashboard_page_header">
    <h2 class="ui dividing header">
        {{ $clinicalRecord->name }}
    </h2>
</div>
<div class="ui segment">
    <h4><span class="ui red text">@lang("dashboard.note_uppercase"): </span>@lang("dashboard.instruction_empty_fields_allowed")</h4>
</div>
<form action="{{ route("dashboard_clinical_record_register_save", [
        "patient_id" => $patient->patient_id, "clinical_record_id" => $clinicalRecord->clinical_record_id
    ]) }}" class="register_clinical_record_form ui form" method="POST">
    @csrf
    @foreach ($clinicalRecord->getGroups() as $group)
        <h3 class="ui dividing header">{{ $group->title }}</h3>
        @foreach ($group->getFields() as $field)
            <div class="field">
                <label>{{ $field->title }}</label>
                @switch($field->type)
                    @case(App\Enums\ClinicalRecordFieldType::INPUT_TEXT)
                        <input type="text" name="field_{{ $field->clinical_record_field_id }}" 
                            maxlength="500" autocomplete="off"/>
                        @break
                    @case(App\Enums\ClinicalRecordFieldType::TEXT_AREA)
                        <textarea name="field_{{ $field->clinical_record_field_id }}" rows="3" maxlength="500"></textarea>
                        @break
                    @case(App\Enums\ClinicalRecordFieldType::DROPDOWN)
                        <div class="ui selection dropdown">
                            <input type="hidden" name="field_{{ $field->clinical_record_field_id }}" required/>
                            <i class="dropdown icon"></i>
                            <div class="default text">{{ $field->title }}</div>
                            <div class="menu">
                                @foreach ($field->getOptions() as $option)
                                    <div class="item" data-value="{{ $option->clinical_record_field_option_id }}">
                                        {{ $option->option }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @break
                    @case(App\Enums\ClinicalRecordFieldType::RADIO_BUTTONS)
                        <div class="inline fields">
                            @foreach ($field->getOptions() as $option)
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="field_{{ $field->clinical_record_field_id }}" value="{{ $option->clinical_record_field_option_id }}"/>
                                        <label>{{ $option->option }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @break
                    @case(App\Enums\ClinicalRecordFieldType::CHECKBOXES)
                        <div class="inline fields">
                            @foreach ($field->getOptions() as $option)
                                <div class="field">
                                    <div class="ui checkbox">
                                        <input type="checkbox" name="field_{{ $field->clinical_record_field_id }}" value="{{ $option->clinical_record_field_option_id }}"/>
                                        <label>{{ $option->option }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @break
                    @default
                @endswitch
            </div>
        @endforeach
    @endforeach
    <div class="ui error message"></div>
    <button class="ui green right floated labeled icon button" type="submit" onclick="saveChanges(this, false);">
        <i class="check icon"></i>
        @lang("dashboard.register")
    </button>
</form>
