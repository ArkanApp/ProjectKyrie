<script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
<script>
    $(document).ready(function () {
        window.hashArguments[0] = "{{ $patient->patient_id }}";
        window.menuRecord("show");
        window.changeMenuActiveButton("#consultations_button");
        $(".ui.dropdown").dropdown({
            action: "select"
        });
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
                @lang("dashboard.question_cancel_consultation")
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
    <h2 class="ui header">@lang("dashboard.consultations")</h2>
    <a href="#patient/{{ $patient->patient_id }}/consultations/register" class="ui green labeled icon button">
        <i class="plus icon"></i>
        @lang("dashboard.new_consultation")
    </a>
</div>
<table class="ui unstackable padded striped celled table">
    <thead>
        <tr>
            <th>@lang("dashboard.date_and_hour")</th>
            <th>@lang("dashboard.status")</th>
            <th>@lang("dashboard.treatment")</th>
            <th>@lang("dashboard.duration")</th>
            <th>@lang("dashboard.cost")</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($consultationsPaginator->items() as $consultation)
            <tr>
                <td>{{ $consultation->getConsultationDate() }}</td>
                @switch ($consultation->status)
                    @case (App\Enums\ConsultationStatus::SCHEDULED)
                        <td class="blue">
                            <i class="exclamation icon"></i>
                            {{ $consultation->getStatus() }}
                        </td>
                        @break
                    @case (App\Enums\ConsultationStatus::RESCHEDULED)
                        <td class="warning">
                            <i class="exclamation icon"></i>
                            {{ $consultation->getStatus() }}
                        </td>
                        @break
                    @case (App\Enums\ConsultationStatus::IN_PROGRESS)
                        <td class="teal">
                            <i class="angle right icon"></i>
                            {{ $consultation->getStatus() }}
                        </td>
                        @break
                    @case (App\Enums\ConsultationStatus::FINISHED)
                        <td class="positive">
                            <i class="check icon"></i>
                            {{ $consultation->getStatus() }}
                        </td>
                        @break
                    @case (App\Enums\ConsultationStatus::CANCELLED)
                        <td class="negative">
                            <i class="close icon"></i>
                            {{ $consultation->getStatus() }}
                        </td>
                        @break
                    @default
                        <td>{{ $consultation->getStatus() }}</td>
                @endswitch
                <td>{{ $consultation->treatment }}</td>
                <td>{{ $consultation->duration ? $consultation->duration . " " . __("dashboard.minutes") : __("dashboard.not_finished_yet") }}</td>
                <td>{{ $consultation->cost ?? __("dashboard.not_defined") }}</td>
                <td>
                    <div class="ui floating dropdown icon blue fluid button">
                        <i class="dropdown icon"></i>
                        <div class="text">@lang("dashboard.actions")</div>
                        <div class="menu">
                            @if ($consultation->status != App\Enums\ConsultationStatus::FINISHED && $consultation->status != App\Enums\ConsultationStatus::CANCELLED)
                                <div class="item" data-consultation="{{ $consultation->consultation_id }}" onclick="showCancelConsultationModal(this);">
                                    <i class="close icon"></i>
                                    @lang("dashboard.cancel")
                                </div>
                                @if ($consultation->status != App\Enums\ConsultationStatus::RESCHEDULED)
                                    <div class="item" data-consultation="{{ $consultation->consultation_id }}" onclick="showRescheduleConsultationModal(this);">
                                        <i class="calendar icon"></i>
                                        @lang("dashboard.reschedule")
                                    </div>
                                @endif
                            @endif
                            <a class="item" href="#patient/{{ $patient->patient_id }}/consultation/{{ $consultation->consultation_id }}/details">
                                <i class="exclamation icon"></i>
                                @lang("dashboard.view_details")
                            </a>
                            @if ($consultation->status != App\Enums\ConsultationStatus::FINISHED && 
                                 $consultation->status != App\Enums\ConsultationStatus::CANCELLED &&
                                 $consultation->consultation_date <= Carbon\Carbon::now())
                                <a class="item" href="#patient/{{ $patient->patient_id }}/consultation/{{ $consultation->consultation_id }}/finish">
                                    <i class="edit icon"></i>
                                    @lang("dashboard.finish")
                                </a>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
