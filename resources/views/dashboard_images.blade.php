<script>
    $(document).ready(function () {
        window.hashArguments[0] = "{{ $patient->patient_id }}";
        window.menuRecord("show");
        window.changeMenuActiveButton("#images_button");
    });
</script>
<div id="image_modal" class="ui basic modal">
    <div class="content">
        <img class="ui centered image" src="" alt=""/>
    </div>
</div>
<div class="dashboard_page_header">
    <h2 class="ui header">{{ __("dashboard.images_of", ["name" => $patient->name]) }}</h2>
    <a href="#patient/{{ $patient->patient_id }}/images/add" class="ui green labeled icon button">
        <i class="plus icon"></i>
        @lang("dashboard.add_image")
    </a>
</div>
<br>
<div class="ui stackable cards">
    @foreach ($images as $image)
        <div class="card">
            <div class="image">
                <img class="ui centered tiny image" src="{{ $image->getPictureUrl() }}" alt="{{ $image->title }}" style="width:150px;"/>
            </div>
            <div class="content">
                <div class="header">{{ $image->title }}</div>
                <div class="description">@lang("dashboard.upload_date"): {{ $image->getUploadDate() }}</div>
            </div>
            <div class="view_image_button ui bottom attached primary button" onclick="viewImage(this);">
                <i class="eye icon"></i>
                @lang("dashboard.view_image")
            </div>
        </div>
    @endforeach
</div>
