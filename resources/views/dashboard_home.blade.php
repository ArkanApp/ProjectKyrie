<script>
    $(document).ready(function () {
        var calendarLoaded = false;
        $("#calendar").fullCalendar({
            defaultView: 'listWeek',
            timezone: "local",
            aspectRatio: 3,
            events: [],
            eventClick: function (selectedEvent, jsEvent, view) {
                showConsultationModal(selectedEvent);
            },
            viewRender: function (view, element) {
                $.getJSON(
                    "/dashboard/home/filterConsultations/" + view.start.subtract("1", "days").format() + "/" + view.end.format(),
                    function (response) {
                        $("#calendar").fullCalendar("removeEvents");
                        $("#calendar").fullCalendar("renderEvents", JSON.parse(response));
                    }
                );
            }
        });
        window.changeMenuActiveButton("#home_button");
        window.menuRecord("hide");
    });
</script>
<h3 class="ui header">
    {{ __("dashboard.welcome_message", ["name" => $account->name]) }}<br>
    {{ trans_choice("dashboard.todays_consults", count($todayConsultations), ["number_of_consultations" => count($todayConsultations)]) }}
</h3>
<div id="calendar"></div>
