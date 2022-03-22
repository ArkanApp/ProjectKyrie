@php
    use App\Enums\ConsultationStatus;
    $statusColumnColor = "inverted ";
    switch ($consultation->status) {
        case ConsultationStatus::SCHEDULED:
            $statusColumnColor .= "blue";
            break;
        case ConsultationStatus::RESCHEDULED:
            $statusColumnColor .= "orange";
            break;
        case ConsultationStatus::CANCELLED:
            $statusColumnColor .= "red";
            break;
        case ConsultationStatus::FINISHED:
            $statusColumnColor .= "green";
            break;
    }
    $prescription = $consultation->getPrescription();
    $evolutionNote = $consultation->getEvolutionNote();
@endphp
<script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
<script>
    $(document).ready(function () {
        window.hashArguments[0] = "{{ $patient->patient_id }}";
        window.menuRecord("show");
        window.changeMenuActiveButton("#consultations_button");
        $("#consultation_selector_calendar").calendar({
            monthFirst: false,
            minDate: new Date(),
            onChange: function (date, text) {
                if (date !== undefined) {
                    $("input[name=consultation_date_format]").val(date.toISOString());
                }
            },
            popupOptions: {
                observeChanges: false
            }
        });
    });
</script>
<div id="reschedule_consultation_modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">@lang("dashboard.reschedule_consultation")</div>
    <div class="content">
        <div class="ui clearing segment">
            <form action="{{ route("dashboard_reschedule_consultation_save", ["patient_id" => $patient->patient_id]) }}" class="reschedule_consultation_form ui form" method="POST">
                @csrf
                <div class="required field">
                    <input type="hidden" name="consultation_id" required/>
                </div>
                <div class="required field">
                    <label>@lang("dashboard.new_date")</label>
                    <div class="ui calendar" id="consultation_selector_calendar">
                        <div class="ui input left icon">
                            <i class="calendar icon"></i>
                            <input type="text" name="calendar_date" placeholder="@lang("dashboard.new_date")" autocomplete="off" required/>
                        </div>
                    </div>
                    <input type="hidden" name="consultation_date_format" required/>
                </div>
                <div class="ui error message"></div>
                <div class="ui black right floated deny button" onclick="$('#reschedule_consultation_modal').modal('hide');">
                    @lang("dashboard.close")
                </div>
                <button class="ui primary right floated labeled icon button" type="submit" onclick="saveChanges(this);">
                    <i class="calendar icon"></i>
                    @lang("dashboard.reschedule")
                </button>
            </form>
        </div>
    </div>
</div>
<div id="cancel_consultation_modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">@lang("dashboard.cancel_consultation")</div>
    <div class="content">
        <div class="ui clearing segment">
            <form action="{{ route("dashboard_cancel_consultation_save", ["patient_id" => $patient->patient_id]) }}" class="cancel_consultation_form ui form" method="POST">
                @csrf
                <div class="required field">
                    <input type="hidden" name="consultation_id" required/>
                </div>
                @lang("dashboard.question_cancel_consultation")<br>
                <div class="ui error message"></div>
                <div class="ui black right floated deny button" onclick="$('#cancel_consultation_modal').modal('hide');">
                    @lang("dashboard.close")
                </div>
                <button class="ui red right floated labeled icon button" type="submit" onclick="saveChanges(this);">
                    <i class="calendar icon"></i>
                    @lang("dashboard.cancel")
                </button>
            </form>
        </div>
    </div>
</div>
<div class="dashboard_page_header">
    <h2 class="ui left aligned dividing header">
        @lang("dashboard.consultation_details")
        <div class="sub header">{{ __("dashboard.of_name", ["full_name" => $patient->getFullName()]) }}</div>
    </h2>
    @if ($consultation->status != ConsultationStatus::FINISHED && $consultation->status != ConsultationStatus::CANCELLED)
        <div class="ui right aligned labeled icon red button" data-consultation="{{ $consultation->consultation_id }}" onclick="showCancelConsultationModal(this);">
            <i class="close icon"></i>
            @lang("dashboard.cancel")
        </div>
        @if ($consultation->status != ConsultationStatus::RESCHEDULED)
            <div class="ui right aligned labeled icon orange button" data-consultation="{{ $consultation->consultation_id }}" onclick="showRescheduleConsultationModal(this);">
                <i class="calendar icon"></i>
                @lang("dashboard.reschedule")
            </div>
        @endif
    @endif
    @if ($consultation->status != ConsultationStatus::FINISHED && $consultation->status != ConsultationStatus::CANCELLED &&
         $consultation->consultation_date <= Carbon\Carbon::now())
        <a class="ui right aligned labeled icon primary button" href="#patient/{{ $patient->patient_id }}/consultation/{{ $consultation->consultation_id }}/finish">
            <i class="edit icon"></i>
            @lang("dashboard.finish")
        </a>
    @endif
</div>
<br>
<div class="ui three column stackable equal width grid">
    <div class="row">
        <div class="column">
            <div class="ui basic segment basic_card">
                <h3>@lang("dashboard.date_and_hour")</h3>
                {{ $consultation->getConsultationDate() }}
            </div>
        </div>
        <div class="column">
            <div class="ui basic segment coloured_card {{ $statusColumnColor }}">
                <h3>@lang("dashboard.status")</h3>
                {{ $consultation->getStatus() }}
            </div>
        </div>
        <div class="column">
            <div class="ui basic segment basic_card">
                <h3>@lang("dashboard.duration")</h3>
                {{ $consultation->duration ? $consultation->duration . " " . __("dashboard.minutes") : "No finalizada aún" }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <div class="ui basic segment basic_card">
                <h3>@lang("dashboard.evolution_note")</h3>
                    @if ($evolutionNote != null)
                        {{ $evolutionNote->note }}
                        @php
                            $nextConsultation = $evolutionNote->getNextConsultation();
                        @endphp
                        @if ($nextConsultation != null)
                            <br><br>
                            <b>{{ __("dashboard.next_consultation_date", ["date" => $nextConsultation->getConsultationDate()]) }}</b><br>
                            <a href="#patient/{{ $patient->patient_id }}/consultation/{{ $nextConsultation->consultation_id }}/details" class="ui labeled icon blue button">
                                <i class="info icon"></i>
                                Ver detalles
                            </a>
                        @endif
                    @else
                        {{ __("dashboard.evolution_note_not_registered") }}
                    @endif
            </div>
        </div>
        <div class="column">
            <div class="ui basic segment basic_card">
                <h3>@lang("dashboard.treatment")</h3>
                {{ $consultation->treatment }}
            </div>
        </div>
        <div class="column">
            <div class="ui basic segment basic_card">
                <h3>@lang("dashboard.observations")</h3>
                {{ $consultation->observations != null ?: __("dashboard.no_observations") }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="equal width column">
            <div class="ui basic segment basic_card">
                <h3>@lang("dashboard.prescription")</h3>
                {{ $prescription != null ? $prescription->content : __("dashboard.prescription_not_registered") }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="three wide right floated right aligned column">
            <div class="ui basic segment basic_card">
                <h3>@lang("dashboard.cost")</h3>
                {{ $consultation->getCost() }}
            </div>
        </div>
    </div>
</div>
