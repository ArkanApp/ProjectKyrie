@php
    $account = Auth::user();
    $area = $account->getArea();
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Project Kyrie') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('css/app.css') }}?v=1.0" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.6/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.6/dist/semantic.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone-with-data.min.js"></script>
    <script src="{{ asset('js/system.min.js') }}?v=1.0"></script>
    <script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
</head>
<body>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{ route('dashboard_startup') }}",
                data: {
                    timezone: moment.tz.guess()
                },
                success: function (response) {
                    if (response && response["status"] == "success") {
                        window.location.reload();
                    }
                }
            });
        });
    </script>
    @include("layouts.dashboard_modals")
    <div class="dashboard">
        <div class="dashboard_menu ui vertical inverted menu">
            <div class="logo_menu">
                <h3 class="logo_header ui header">Project Kyrie</h3>
            </div>
            <a id="home_button" class="teal item" href="#home" data-route="#home">
                @lang("dashboard.home")
            </a>
            <a id="patients_button" class="teal item" href="#patients" data-route="#patients">
                @lang("dashboard.patients")
            </a>
            <a id="profile_button" class="teal item" href="#profile" data-route="#profile">
                @lang("dashboard.profile")
            </a>
            <a id="stats_button" class="teal item" href="#stats" data-route="#stats">
                @lang("dashboard.stats")
            </a>
            <a id="clinical_record_generator_button" class="teal item" href="#clinicalRecordGenerator" data-route="#clinicalRecordGenerator">
                @lang("dashboard.clinical_record_generator")
            </a>
            <div class="record_menu">
                <div class="header item">
                    <h3 class="ui inverted header">@lang("dashboard.record")</h3>
                </div>
                <a id="patient_button" class="record_menu_item teal item" data-route="#patient/$" data-args="1">
                    @lang("dashboard.data")
                </a>
                <a id="consultations_button" class="record_menu_item teal item" data-route="#patient/$/consultations" data-args="1">
                    @lang("dashboard.consultations")
                </a>
                <a id="clinical_records_button" class="record_menu_item teal item" data-route="#patient/$/clinicalRecords" data-args="1">
                    @lang("dashboard.clinical_records")
                </a>
                <a id="images_button" class="record_menu_item teal item" data-route="#patient/$/images" data-args="1">
                    @lang("dashboard.images")
                </a>
                <a id="evolution_notes_button" class="record_menu_item teal item" data-route="#patient/$/evolutionNotes" data-args="1">
                    @lang("dashboard.evolution_notes")
                </a>
                @if ($area->area_id == 2)
                    <a id="odontogram_button" class="record_menu_item teal item" data-route="#patient/$/odontogram" data-args="1">
                        @lang("dashboard.odontogram")
                    </a>
                @endif
            </div>
        </div>
        <div class="dashboard_content">
            <div class="menu_content">
                <div class="sidebar_button ui icon button">
                    <i class="align justify icon"></i>
                </div>
                <div class="search_patient ui search">
                    <div class="ui icon input">
                        <input class="prompt" type="text" placeholder="@lang('dashboard.search_patient')"/>
                        <i class="search icon"></i>
                    </div>
                    <div class="results"></div>
                </div>
                <div class="account_dropdown">
                    <img src="{{ $account->getPictureFile() }}" class="ui image"/>
                    <div class="ui dropdown item">
                        <div class="user_data">
                            {{ $account->getFullName() }}<br>{{ $area->name }}
                        </div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <a href="{{ route('account_management') }}" class="item">Administración de la cuenta</a>
                            <div class="item" onclick="$('#logout_form').submit();">@lang("dashboard.logout")</div>
                            <form id="logout_form" action="{{ route("logout") }}" method="post">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $("#loading_modal").modal({ closable: false }).modal("show");
                $(document).ready(function () {
                    loadDashboardPage();
                });
            </script>
            <div class="content_page"></div>
        </div>
    </div>
</body>
</html>
