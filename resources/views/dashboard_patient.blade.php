<script>
    $(document).ready(function () {
        window.hashArguments[0] = "{{ $patient->patient_id }}";
        window.menuRecord("show");
        window.changeMenuActiveButton("#patient_button");
    });
</script>
<div class="dashboard_page_header">
    <h2 class="ui header">{{ __("dashboard.consult_patient_header", ["name" => $patient->name]) }}</h2>
    <a href="#patient/{{ $patient->patient_id }}/modify" class="ui primary labeled icon button">
        <i class="edit icon"></i>
        @lang("dashboard.modify_data")
    </a>
</div>
<div class="ui basic segment patient_record">
    <img class="patient_picture_file ui medium centered image" src="{{ $patient->getPictureFile() }}" alt="{{ $patient->name }}"/>
    <div class="patient_data ui basic segment basic_card">
        <div class="ui three column stackable divided grid">
            <div class="row">
                <div class="column">
                    <div class="ui relaxed divided list">
                        <div class="item">
                            <i class="large user middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.name")</div>
                                <div class="description">{{ $patient->name }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large user_last middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.last_name")</div>
                                <div class="description">{{ $patient->last_name }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large birthday cake middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.birthdate")</div>
                                <div class="description">{{ $patient->getBirthdate(true) }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large venus mars middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.gender")</div>
                                <div class="description">{{ $patient->getGender() }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large building middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.occupation")</div>
                                <div class="description">{{ $patient->occupation }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large graduation cap middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.scholarship")</div>
                                <div class="description">{{ $patient->scholarship }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large ring middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.civil_status")</div>
                                <div class="description">{{ $patient->getCivilStatus() }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large flag middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.nationality")</div>
                                <div class="description">{{ $patient->getNationality() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui relaxed divided list">
                        <div class="item">
                            <i class="large road middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.street1")</div>
                                <div class="description">{{ $patient->street1 }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large road_2 middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.external_number")</div>
                                <div class="description">{{ $patient->external_number }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large road_3 middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.internal_number")</div>
                                <div class="description">{{ $patient->internal_number }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large road_4 middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.colony")</div>
                                <div class="description">{{ $patient->colony }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large road_5 middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.municipality")</div>
                                <div class="description">{{ $patient->municipality }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large road_6 middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.state")</div>
                                <div class="description">{{ $patient->state }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large road_7 middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.zipcode")</div>
                                <div class="description">{{ $patient->zipcode }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui relaxed divided list">
                        <div class="item">
                            <i class="large phone middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.home_phone")</div>
                                <div class="description">{{ $patient->home_phone }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large mobile alternate middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.cell_phone")</div>
                                <div class="description">{{ $patient->cell_phone }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large at middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.email")</div>
                                <div class="description">{{ $patient->email }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large calendar alternate middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.register_date")</div>
                                <div class="description">{{ $patient->getRegisterDate() }}</div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="large calendar check middle aligned icon"></i>
                            <div class="content">
                                <div class="header">@lang("dashboard.last_update")</div>
                                <div class="description">{{ $patient->getLastUpdate() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
