<script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
<script>
    $(document).ready(function () {
        window.hashArguments[0] = "{{ $patient->patient_id }}";
        window.menuRecord("show");
        window.changeMenuActiveButton("#evolution_notes_button");
    });
</script>
<div class="dashboard_page_header">
    <h2 class="ui header">@lang("dashboard.evolution_notes")</h2>
</div>
<table class="ui unstackable padded striped celled table">
    <thead>
        <tr>
            <th>@lang("dashboard.date_and_hour")</th>
            <th>@lang("dashboard.note")</th>
            <th>@lang("dashboard.next_consultation")</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($evolutionNotes as $evolutionNote)
            @php
                $consultation = $evolutionNote->getConsultation();
                $nextConsultation = $evolutionNote->getNextConsultation();
            @endphp
            <tr>
                <td>{{ $consultation->getConsultationDate() }}</td>
                <td>{{ $evolutionNote->note }}</td>
                <td>{{ $nextConsultation ? $nextConsultation->getConsultationDate() : __("dashboard.not_defined") }}</td>
                <td>
                    <a class="ui blue labeled icon fluid button" href="#patient/{{ $patient->patient_id }}/consultation/{{ $consultation->consultation_id }}/details">
                        <i class="eye icon"></i>
                        @lang("dashboard.view_consultation")
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
