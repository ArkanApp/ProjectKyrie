<script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
<script>
    $(document).ready(function () {
        window.hashArguments[0] = "{{ $patient->patient_id }}";
        window.menuRecord("show");
        window.changeMenuActiveButton("#images_button");
    });
</script>
<div class="dashboard_page_header">
    <h2 class="ui dividing header">
        @lang("dashboard.add_image")
        <div class="sub header">{{ __("dashboard.for_name", ["full_name" => $patient->getFullName()]) }}</div>
    </h2>
</div>
<br>
<form action="{{ route("dashboard_add_image_save", ["patient_id" => $patient->patient_id]) }}" class="add_patient_image_form ui form" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="required field">
        <label>@lang("dashboard.image")</label>
        <ul class="ui list">
            <li>@lang("dashboard.image_max_size_constraint")</li>
            <li>@lang("dashboard.image_formats_constraint")</li>
        </ul>
        <input type="file" name="image" accept="image/*" required/>
    </div>
    <div class="required field">
        <label>@lang("dashboard.image_title")</label>
        <input type="text" name="title" placeholder="@lang("dashboard.image_title")" maxlength="255" autocomplete="off" required/>
    </div>
    <div class="ui error message"></div>
    <button class="ui green right floated button" type="submit" onclick="saveChanges(this, true);">@lang("dashboard.add_image")</button>
</form>
