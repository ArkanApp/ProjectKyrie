<script>
    $(document).ready(function () {
        window.changeMenuActiveButton("#stats_button");
        window.menuRecord("hide");
    });
</script>
<div class="dashboard_page_header">
    <h2 class="ui header">@lang("dashboard.stats")</h2>
</div>
<br>
<h3>@lang("dashboard.today")</h3>
<div class="ui three columns relaxed stackable grid">
    <div class="row">
        <div class="column">
            <div class="ui basic segment basic_card">
                <div class="ui horizontal statistic">
                    <div class="value">
                        <i class="hospital user icon"></i> {{ $stats->today["patients"] }}
                    </div>
                    <div class="label">
                        @lang("dashboard.registered_patients")
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui basic segment basic_card">
                <div class="ui horizontal statistic">
                    <div class="value">
                        <i class="notes medical icon"></i> {{ $stats->today["amountConsultations"] }}
                    </div>
                    <div class="label">
                        @lang("dashboard.consultations_given")
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui basic segment basic_card">
                <div class="ui horizontal statistic">
                    <div class="value">
                        <i class="notes medical icon"></i> {{ App\Tools\Tools::convertToMoney($stats->today["earnings"]) }}
                    </div>
                    <div class="label">
                        @lang("dashboard.earnings")
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<h3>@lang("dashboard.this_week")</h3>
<div class="ui three columns relaxed stackable grid">
    <div class="row">
        <div class="column">
            <div class="ui basic segment basic_card">
                <div class="ui horizontal statistic">
                    <div class="value">
                        <i class="hospital user icon"></i> {{ $stats->this_week["patients"] }}
                    </div>
                    <div class="label">
                        @lang("dashboard.registered_patients")
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui basic segment basic_card">
                <div class="ui horizontal statistic">
                    <div class="value">
                        <i class="notes medical icon"></i> {{ $stats->this_week["amountConsultations"] }}
                    </div>
                    <div class="label">
                        @lang("dashboard.consultations_given")
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui basic segment basic_card">
                <div class="ui horizontal statistic">
                    <div class="value">
                        <i class="notes medical icon"></i> {{ App\Tools\Tools::convertToMoney($stats->this_week["earnings"]) }}
                    </div>
                    <div class="label">
                        @lang("dashboard.earnings")
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<h3>@lang("dashboard.all_time")</h3>
<div class="ui three columns relaxed stackable grid">
    <div class="row">
        <div class="column">
            <div class="ui basic segment basic_card">
                <div class="ui horizontal statistic">
                    <div class="value">
                        <i class="hospital user icon"></i> {{ $stats->all_time["patients"] }}
                    </div>
                    <div class="label">
                        @lang("dashboard.registered_patients")
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui basic segment basic_card">
                <div class="ui horizontal statistic">
                    <div class="value">
                        <i class="notes medical icon"></i> {{ $stats->all_time["amountConsultations"] }}
                    </div>
                    <div class="label">
                        @lang("dashboard.consultations_given")
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui basic segment basic_card">
                <div class="ui horizontal statistic">
                    <div class="value">
                        <i class="notes medical icon"></i> {{ App\Tools\Tools::convertToMoney($stats->all_time["earnings"]) }}
                    </div>
                    <div class="label">
                        @lang("dashboard.earnings")
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
