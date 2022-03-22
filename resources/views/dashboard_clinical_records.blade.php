<script>
    $(document).ready(function () {
        window.hashArguments[0] = "{{ $patient->patient_id }}";
        window.menuRecord("show");
        window.changeMenuActiveButton("#clinical_records_button");
        $(".ui.dropdown").dropdown({
            action: "select"
        });
    });
</script>
<div class="dashboard_page_header">
    <h3 class="ui header">@lang("dashboard.clinical_records")</h3>
    <a class="ui green labeled icon button" href="#patient/{{ $patient->patient_id }}/clinicalRecords/register">
        <i class="plus icon"></i>
        @lang("dashboard.new_clinical_record")
    </a>
</div>
<table class="ui unstackable padded striped celled table">
    <thead>
        <tr>
            <th>@lang("dashboard.register_date")</th>
            <th>@lang("dashboard.name")</th>
            <th>@lang("dashboard.status")</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clinicalRecords as $clinicalRecord)
            <tr>
                <td>{{ $clinicalRecord->getRegisterDate($patient->patient_id) }}</td>
                <td>{{ $clinicalRecord->name }}</td>
                @if ($clinicalRecord->hasAllFieldsFilled($patient->patient_id))
                    <td class="positive">
                        <i class="check icon"></i>
                        @lang("dashboard.completed")
                    </td>
                @else
                    <td class="negative">
                        <i class="close icon"></i>
                        @lang("dashboard.not_completed")
                    </td>
                @endif
                <td>
                    <div class="ui floating dropdown icon blue fluid button">
                        <i class="dropdown icon"></i>
                        <div class="text">@lang("dashboard.actions")</div>
                        <div class="menu">
                            <a class="item" href="#patient/{{ $patient->patient_id }}/clinicalRecord/{{ $clinicalRecord->clinical_record_id }}/consult">
                                <i class="info icon"></i>
                                @lang("dashboard.consult")
                            </a>
                            <a class="item" href="#patient/{{ $patient->patient_id }}/clinicalRecord/{{ $clinicalRecord->clinical_record_id }}/modify">
                                <i class="edit icon"></i>
                                @lang("dashboard.modify")
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
