<script>
    $(document).ready(function () {
        window.changeMenuActiveButton("#profile_button");
        window.menuRecord("hide");
    });
</script>
<div class="dashboard_page_header">
    <h2 class="ui header">@lang("dashboard.profile")</h2>
</div>
<div class="ui basic segment basic_card">
    <h3>@lang("dashboard.profile_info")</h3>
    <div class="ui two column stackable divided grid">
        <div class="row">
            <div class="five wide column">
                <img src="{{ $account->getPictureFile() }}" alt="{{ $account->getFullName() }}" class="ui small centered image"/>
            </div>
            <div class="column">
                <div class="ui relaxed divided list">
                    <div class="item">
                        <i class="large user middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.name")</div>
                            <div class="description">{{ $account->name }}</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large user_last middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.last_name")</div>
                            <div class="description">{{ $account->last_name }}</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large at middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.email")</div>
                            <div class="description">{{ $account->email }}</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large book medical middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.area")</div>
                            <div class="description">{{ $area->name }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="ui basic segment basic_card">
    <div class="dashboard_segment_header">
        <h3 class="ui left floated header">@lang("dashboard.clinic_info")</h3>
        <a href="#clinic/modify" class="ui right floated primary labeled icon button">
            <i class="edit icon"></i>
            @lang("dashboard.modify")
        </a>
    </div>
    <div class="ui three column stackable divided grid">
        <div class="row">
            <div class="five wide column">
                <img src="{{ $clinic->getPictureFile() }}" alt="{{ $clinic->name }}" class="ui small centered image"/>
            </div>
            <div class="column">
                <div class="ui relaxed divided list">
                    <div class="item">
                        <i class="large user middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.name")</div>
                            <div class="description">{{ $clinic->name }}</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large flag middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.country")</div>
                            <div class="description">{{ App\Enums\Country::getText($clinic->country) }}</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large road middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.street1")</div>
                            <div class="description">{{ $clinic->street1 }}</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large road_2 middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.external_number")</div>
                            <div class="description">{{ $clinic->external_number }}</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large road_3 middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.internal_number")</div>
                            <div class="description">{{ $clinic->internal_number }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="ui relaxed divided list">
                    <div class="item">
                        <i class="large road_4 middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.colony")</div>
                            <div class="description">{{ $clinic->colony }}</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large road_5 middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.municipality")</div>
                            <div class="description">{{ $clinic->municipality }}</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large road_6 middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.state")</div>
                            <div class="description">{{ $clinic->state }}</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large road_7 middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.zipcode")</div>
                            <div class="description">{{ $clinic->zipcode }}</div>
                        </div>
                    </div>
                    <div class="item">
                        <i class="large phone middle aligned icon"></i>
                        <div class="content">
                            <div class="header">@lang("dashboard.phone")</div>
                            <div class="description">{{ $clinic->phone }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
