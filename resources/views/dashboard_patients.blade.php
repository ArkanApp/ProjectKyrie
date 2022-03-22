<script>
    $(document).ready(function () {
        window.changeMenuActiveButton("#patients_button");
        window.menuRecord("hide");
    });
</script>
<div class="dashboard_page_header">
    <h3 class="ui header">@lang("dashboard.patients")</h3>
    <a class="ui green labeled icon button" href="#patients/register">
        <i class="plus icon"></i>
        @lang("dashboard.new_patient")
    </a>
</div>
<table class="ui unstackable padded striped celled table">
    <thead>
        <tr>
            <th>@lang("dashboard.photo")</th>
            <th>@lang("dashboard.name")</th>
            <th>@lang("dashboard.last_name")</th>
            <th>@lang("dashboard.email")</th>
            <th>@lang("dashboard.home_phone")</th>
            <th>@lang("dashboard.cell_phone")</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patientsPaginator->items() as $patient)
            <tr>
                <td>
                    <img class="ui tiny centered image" src="{{ $patient->getPictureFile() }}" alt="{{ $patient->getFullName() }}"/>
                </td>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->last_name }}</td>
                <td>{{ $patient->email }}</td>
                <td>{{ $patient->home_phone }}</td>
                <td>{{ $patient->cell_phone }}</td>
                <td>
                    <script>
                        $(".ui.dropdown").dropdown({
                            action: "select"
                        });
                    </script>
                    <div class="ui floating dropdown icon blue fluid button">
                        <i class="dropdown icon"></i>
                        <div class="text">@lang("dashboard.actions")</div>
                        <div class="menu">
                            <a class="item" href="#patient/{{ $patient->patient_id }}/consultations/register">
                                <i class="notes medical icon"></i>
                                @lang("dashboard.new_consultation")
                            </a>
                            <a class="item" href="#patient/{{ $patient->patient_id }}/modify">
                                <i class="edit icon"></i>
                                @lang("dashboard.modify_data")
                            </a>
                            <a class="item" href="#patient/{{ $patient->patient_id }}">
                                <i class="info icon"></i>
                                @lang("dashboard.consult_record")
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="ui pagination menu right floated">
    @for ($page = 1, $totalPages = $patientsPaginator->lastPage(); $page <= $totalPages; $page++)
        <a href="#patients?page={{ $page }}" class="{{ ($patientsPaginator->currentPage() == $page) ? "disabled " : "" }}item">{{ $page }}</a>
    @endfor
</div>
