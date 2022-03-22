<script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
<script>
    $(document).ready(function () {
        window.hashArguments[0] = "{{ $patient->patient_id }}";
        window.menuRecord("show");
        $("#clinical_records_dropdown").dropdown({
            preserveHTML: false,
        });
        $("#clinical_records_dropdown input").change(function () {
            $("#clinical_record").addClass("loading");
            $("#clinical_record").load(
                "/dashboard/patient/{{ $patient->patient_id }}/clinicalRecord/" + $("#clinical_records_dropdown input").val() + "/register",
                null, function (response, status, request) {
                    $("#clinical_record").removeClass("loading");
                }
            );
        });
    });
</script>
<div class="dashboard_page_header">
    <h2 class="ui dividing header">
        @lang("dashboard.register_clinical_record")
        <div class="sub header">{{ __("dashboard.for_name", ["full_name" => $patient->getFullName()]) }}</div>
    </h2>
</div>
<br>
<label>@lang("dashboard.select_clinical_record")</label>
<br>
<div class="ui search selection dropdown" id="clinical_records_dropdown">
    <input type="hidden" name="gender" required>
    <i class="dropdown icon"></i>
    <div class="default text">@lang("dashboard.clinical_record")</div>
    <div class="menu">
        @foreach ($clinicalRecords as $clinicalRecord)
            <div class="item" data-value="{{ $clinicalRecord->clinical_record_id }}">
                {{ $clinicalRecord->name }}
            </div>
        @endforeach
    </div>
</div>
<div id="clinical_record" class="ui basic fitted segment"></div>
