window.hashArguments = [];
window.showLoadingScreen = function () {
    $("#loading_modal").modal({ closable: false }).modal("show");
};
window.hideLoadingScreen = function () {
    setTimeout(function () {
        $("#loading_modal").modal("hide");
    }, 500);
};
window.menuRecord = function (option) {
    $(".record_menu").css("display", option === "show" ? "block" : "none");
};
window.changeMenuActiveButton = function (buttonId) {
    $(".dashboard .menu .item.active").removeClass("active");
    $(buttonId).addClass("active");
}
window.onhashchange = function () {
    loadDashboardPage();
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: window.location.href,
    type: "POST"
});

function loadDashboardPage(self, numArgs) {
    if (window.location.pathname !== "/dashboard") {
        return false;
    }
    if (self === undefined && numArgs === undefined) {
        if (location.hash.length <= 1) {
            location.hash = "#home";
            $("#home_button").addClass("active");
            return false;
        }
        window.showLoadingScreen();
        const hash = location.hash.split("#")[1];
        $(".content_page").load("/dashboard/" + hash, function (_, _, _) {
            window.hideLoadingScreen();
        });
        return;
    }
    var url = $(self).attr("data-route");
    for (let index = 0; index < numArgs; index++) {
        const argValue = window.hashArguments[index];
        var counter = 0;
        url = url.replace(/\$/g, function (match) {
            return (counter++ === index) ? argValue : match;
        });
    }
    location.hash = url;
}

function onResizing() {
    if ($(window).width() <= 1075) {
        $(".dashboard_menu").addClass("sidebar");
        $(".dashboard_content").addClass("pusher");
        $(".sidebar_button").css("display", "block");
    } else {
        $(".dashboard_menu").removeClass("sidebar");
        $(".dashboard_content").removeClass("pusher");
        $(".sidebar_button").css("display", "none");
    }
}

$(document).ready(function () {
    onResizing();
    $(window).resize(function () {
        onResizing();
    });
    $(".ui.checkbox").checkbox();
    $(".ui.dropdown").dropdown();
    $("#user_dropdown").dropdown({
        action: "select"
    });
    $(".sidebar_button").click(function () {
        $(".sidebar").sidebar({
            context: ".dashboard",
            transition: "push"
        }).sidebar("toggle");
    });
    $(".search_patient").search({
        preserveHTML: false,
        apiSettings: {
            url: "/dashboard/patients/search/{query}",
            onResponse: function (patientsResponse) {
                const response = {
                    patients: []
                };
                $.each(patientsResponse.patients, function (_, patient) {
                    response.patients.push({
                        full_name: patient.name + " " + patient.last_name,
                        picture_file: "/image/patientPictureFiles/" + (patient.picture_file == null ? "default.png" : patient.picture_file),
                        url: "#patient/" + patient.patient_id
                    });
                });
                return response;
            }
        },
        fields: {
            results: "patients",
            title: "full_name",
            url: "url",
            image: "picture_file"
        },
        minCharacters: 3
    });

    $(".dashboard .menu .item").click(function (event) {
        $(".dashboard .menu .item.active").removeClass("active");
        $(event.target).addClass("active");
        loadDashboardPage(event.target, $(event.target).attr("data-args"));
    });
    loadDashboardPage();
});

function showConsultationModal(consultationEvent) {
    const consultationDate = new Date(consultationEvent.start);
    const consultationDateFormat = new Intl.DateTimeFormat(
        "default", {
            year: "numeric",
            month: "short",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit"
        }
    ).format(consultationDate);
    $("#consultation_modal .content .image img").attr("src", consultationEvent.patient.pictureFile);
    $("#consultation_modal .consultation_patient_name").html(consultationEvent.patient.fullName);
    $("#consultation_modal .consultation_date .description").html(consultationDateFormat);
    $("#consultation_modal .consultation_treatment .description").html(consultationEvent.treatment);
    $("#consultation_modal .consultation_status .description").html(consultationEvent.status);
    $("#consultation_modal #consult_record").attr("href", "#patient/" + consultationEvent.patient.id);
    $("#consultation_modal").modal("show");
}

function viewImage(self) {
    const image = $(self).parent().children(".image").children("img");
    $("#image_modal .content img").attr("src", image.attr("src"));
    $("#image_modal .content img").attr("alt", image.attr("alt"));
    $("#image_modal").modal("show");
}

function showRescheduleConsultationModal(self) {
    $("input[name=consultation_id]").val($(self).attr("data-consultation"));
    $("#reschedule_consultation_modal").modal("show");
}

function showCancelConsultationModal(self) {
    $("input[name=consultation_id]").val($(self).attr("data-consultation"));
    $("#cancel_consultation_modal").modal("show");
}

function showAddDiseaseModal(self) {
    const toothNumber = $(self).attr("data-tooth");
    $("input[name=tooth_number]").val(toothNumber);
    $("#add_disease_modal .tooth_number").html(toothNumber);
    $("input[name=tooth_selected_faces]").val("");
    $("#add_disease_modal .odontogram_tooth_path").each(function (_, element) {
        $(element).removeClass("active");
    });
    $(".ui.error.message").css("display", "none");
    $("#add_disease_modal").modal("show");
}

function selectToothFace(self) {
    const facesVal = $("input[name=tooth_selected_faces]").val();
    const selectedToothFace = $(self).attr("data-face");
    if (facesVal.includes(selectedToothFace)) {
        const newFacesVal = facesVal.replace(selectedToothFace + "_", "");
        $("input[name=tooth_selected_faces]").val(newFacesVal);
        $(self).removeClass("active");
        return;
    }
    if (!$(self).hasClass("active")) {
        $("input[name=tooth_selected_faces]").val(facesVal + selectedToothFace + "_");
        $(self).addClass("active");
    }
}

function onSelectCervicalFaceOdontogram(self) {
    const facesVal = $("input[name=tooth_selected_faces]").val();
    if (!$(self).children("input").is(":checked")) {
        $("input[name=tooth_selected_faces]").val(facesVal + "cervical_");
    } else {
        const newFacesVal = facesVal.replace("cervical_", "");
        $("input[name=tooth_selected_faces]").val(newFacesVal);
    }
}
