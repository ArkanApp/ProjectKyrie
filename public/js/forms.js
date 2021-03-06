formRules = {
    ".auth_form": {
        name: {
            identifier: "name",
            rules: [{
                type: "empty",
                prompt: "Ingresa un nombre"
            }, {
                type: "maxLength[100]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        last_name: {
            identifier: "last_name",
            rules: [{
                type: "empty",
                prompt: "Ingresa al menos un apellido"
            }, {
                type: "maxLength[100]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        email: {
            identifier: "email",
            rules: [{
                type: "empty",
                prompt: "Ingresa un correo electrónico"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "email",
                prompt: "Ingresa un correo electrónico válido"
            }]
        },
        password: {
            identifier: "password",
            rules: [{
                type: "empty",
                prompt: "Ingresa una contraseña"
            }, {
                type: "minLength[8]",
                prompt: "Ingresa un mínimo de {ruleValue} caracteres"
            }]
        },
        password_confirmation: {
            identifier: "password_confirmation",
            rules: [{
                type: "empty",
                prompt: "Ingresa la confirmación de la contraseña que colocaste anteriormente"
            }, {
                type: "minLength[8]",
                prompt: "Ingresa un mínimo de {ruleValue} caracteres"
            }, {
                type: "match[password]",
                prompt: "Las contraseñas no coinciden"
            }]
        }
    },
    ".register_patient_form": {
        name: {
            identifier: "name",
            rules: [{
                type: "empty",
                prompt: "Ingresa un nombre"
            }, {
                type: "maxLength[100]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        last_name: {
            identifier: "last_name",
            rules: [{
                type: "empty",
                prompt: "Ingresa al menos un apellido"
            }, {
                type: "maxLength[100]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        gender: {
            identifier: "gender",
            rules: [{
                type: "empty",
                prompt: "Selecciona un género"
            }, {
                type: "integer",
                prompt: "Selecciona un género de la lista"
            }]
        },
        occupation: {
            identifier: "occupation",
            rules: [{
                type: "empty",
                prompt: "Ingresa una ocupación"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        scholarship: {
            identifier: "scholarship",
            rules: [{
                type: "empty",
                prompt: "Ingresa una escolaridad"
            }, {
                type: "maxLength[100]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        civil_status: {
            identifier: "civil_status",
            rules: [{
                type: "empty",
                prompt: "Selecciona un estado civil"
            }, {
                type: "integer",
                prompt: "Selecciona un estado civil de la lista"
            }]
        },
        nationality: {
            identifier: "nationality",
            rules: [{
                type: "empty",
                prompt: "Selecciona una nacionalidad"
            }, {
                type: "integer",
                prompt: "Selecciona una nacionalidad de la lista"
            }]
        },
        email: {
            identifier: "email",
            rules: [{
                type: "empty",
                prompt: "Ingresa un correo electrónico"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "email",
                prompt: "Ingresa un correo electrónico válido"
            }]
        },
        home_phone: {
            identifier: "home_phone",
            rules: [{
                type: "empty",
                prompt: "Ingresa un teléfono de casa"
            }, {
                type: "minLength[10]",
                prompt: "Ingresa un mínimo de {ruleValue} caracteres"
            }, {
                type: "maxLength[15]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        },
        cell_phone: {
            identifier: "cell_phone",
            rules: [{
                type: "empty",
                prompt: "Ingresa un teléfono celular"
            }, {
                type: "minLength[10]",
                prompt: "Ingresa un mínimo de {ruleValue} caracteres"
            }, {
                type: "maxLength[15]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        },
        street1: {
            identifier: "street1",
            rules: [{
                type: "empty",
                prompt: "Ingresa una calle principal"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        external_number: {
            identifier: "external_number",
            rules: [{
                type: "empty",
                prompt: "Ingresa un número externo"
            }, {
                type: "maxLength[11]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        },
        internal_number: {
            identifier: "internal_number",
            optional: true,
            rules: [{
                type: "maxLength[11]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        },
        colony: {
            identifier: "colony",
            rules: [{
                type: "empty",
                prompt: "Ingresa una colonia"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        municipality: {
            identifier: "municipality",
            rules: [{
                type: "empty",
                prompt: "Ingresa un municipio"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        state: {
            identifier: "state",
            rules: [{
                type: "empty",
                prompt: "Ingresa un estado"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        zipcode: {
            identifier: "zipcode",
            rules: [{
                type: "empty",
                prompt: "Ingresa un código postal"
            }, {
                type: "maxLength[10]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        }
    },
    ".add_patient_image_form": {
        title: {
            identifier: "title",
            rules: [{
                type: "empty",
                prompt: "Ingresa un título"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
    },
    ".reschedule_consultation_form": {
        calendar_date_format: {
            identifier: "calendar_date_format",
            rules: [{
                type: "empty",
                prompt: "Selecciona una fecha"
            }]
        }
    },
    ".finish_consultation_form": {
        duration: {
            identifier: "duration",
            rules: [{
                type: "empty",
                prompt: "Ingresa una duración en minutos"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        },
        observations: {
            identifier: "observations",
            optional: true,
            rules: [{
                type: "maxLength[65535]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        prescription_content: {
            identifier: "prescription_content",
            optional: true,
            rules: [{
                type: "maxLength[65535]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        evolution_note_note: {
            identifier: "evolution_note_note",
            optional: true,
            rules: [{
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        treatment: {
            identifier: "treatment",
            optional: true,
            rules: [{
                type: "maxLength[65535]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        cost: {
            identifier: "cost",
            optional: true,
            rules: [{
                type: "number",
                prompt: "Ingresa solo números con o sin decimal"
            }]
        },
    },
    ".add_disease_form": {
        tooth_number: {
            identifier: "tooth_number",
            rules: [{
                type: "empty",
                prompt: "Selecciona un diente"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        }
    },
    ".modify_clinic_form": {
        name: {
            identifier: "name",
            rules: [{
                type: "empty",
                prompt: "Ingresa un nombre"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        phone: {
            identifier: "phone",
            rules: [{
                type: "empty",
                prompt: "Ingresa un teléfono"
            }, {
                type: "minLength[10]",
                prompt: "Ingresa un mínimo de {ruleValue} caracteres"
            }, {
                type: "maxLength[15]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        },
        street1: {
            identifier: "street1",
            rules: [{
                type: "empty",
                prompt: "Ingresa una calle principal"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        external_number: {
            identifier: "external_number",
            rules: [{
                type: "empty",
                prompt: "Ingresa un número externo"
            }, {
                type: "maxLength[11]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        },
        internal_number: {
            identifier: "internal_number",
            optional: true,
            rules: [{
                type: "maxLength[11]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        },
        colony: {
            identifier: "colony",
            rules: [{
                type: "empty",
                prompt: "Ingresa una colonia"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        municipality: {
            identifier: "municipality",
            rules: [{
                type: "empty",
                prompt: "Ingresa un municipio"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        state: {
            identifier: "state",
            rules: [{
                type: "empty",
                prompt: "Ingresa un estado"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        zipcode: {
            identifier: "zipcode",
            rules: [{
                type: "empty",
                prompt: "Ingresa un código postal"
            }, {
                type: "maxLength[10]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        }
    },
    ".register_clinic_form": {
        name: {
            identifier: "name",
            rules: [{
                type: "empty",
                prompt: "Ingresa un nombre"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        phone: {
            identifier: "phone",
            rules: [{
                type: "empty",
                prompt: "Ingresa un teléfono"
            }, {
                type: "minLength[10]",
                prompt: "Ingresa un mínimo de {ruleValue} caracteres"
            }, {
                type: "maxLength[15]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        },
        street1: {
            identifier: "street1",
            rules: [{
                type: "empty",
                prompt: "Ingresa una calle principal"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        external_number: {
            identifier: "external_number",
            rules: [{
                type: "empty",
                prompt: "Ingresa un número externo"
            }, {
                type: "maxLength[11]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        },
        internal_number: {
            identifier: "internal_number",
            optional: true,
            rules: [{
                type: "maxLength[11]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        },
        colony: {
            identifier: "colony",
            rules: [{
                type: "empty",
                prompt: "Ingresa una colonia"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        municipality: {
            identifier: "municipality",
            rules: [{
                type: "empty",
                prompt: "Ingresa un municipio"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        state: {
            identifier: "state",
            rules: [{
                type: "empty",
                prompt: "Ingresa un estado"
            }, {
                type: "maxLength[255]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        },
        zipcode: {
            identifier: "zipcode",
            rules: [{
                type: "empty",
                prompt: "Ingresa un código postal"
            }, {
                type: "maxLength[10]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }, {
                type: "integer",
                prompt: "Ingresa solo números"
            }]
        }
    },
    ".clinical_record_generator_form": {
        name: {
            identifier: "name",
            rules: [{
                type: "empty",
                prompt: "Ingresa el nombre de este registro clínico"
            }, {
                type: "maxLength[100]",
                prompt: "Ingresa un máximo de {ruleValue} caracteres"
            }]
        }
    }
};

$(document).ready(function () {
    for (var formName in formRules) {
        initializeForm(formName);
    }
});

function initializeForm(formName) {
    $(formName).form({
        fields: formRules[formName],
        inline: true,
        on: 'blur',
        preventLeaving: true,
        keyboardShortcuts: false
    });
    $('form input').on('keypress', function (e) {
        return e.which !== 13;
    });
}

function saveChanges(submitButton, hasAFile = false, extraData = null) {
    event.preventDefault();
    var formClass = $(submitButton).parent();
    if ($(formClass).form('is valid')) {
        $(submitButton).addClass("loading disabled");
        if (!hasAFile) {
            $.ajax({
                url: $(formClass).attr("action"),
                data: {
                    "formData": $(formClass).form('get values'),
                    "extraData": extraData
                },
                success: function (response) {
                    $(submitButton).removeClass("loading disabled");
                    if (response && response["status"] == "success") {
                        if (response["redirection"].length == 0) {
                            $(submitButton).addClass("disabled");
                            return;
                        }
                        if (location.hash == response["redirection"]) {
                            window.dispatchEvent(new HashChangeEvent("hashchange"))
                        } else {
                            window.location.href = response["redirection"];
                        }
                    } else {
                        $(".ui.error.message").html("Ocurrió un error al guardar los cambios.");
                        $(".ui.error.message").css("display", "block");
                    }
                }
            });
        } else {
            $.ajax({
                url: $(formClass).attr("action"),
                data: new FormData($(formClass)[0]),
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $(submitButton).removeClass("loading disabled");
                    if (response && response["status"] == "success") {
                        if (response["redirection"].length == 0) {
                            $(submitButton).addClass("disabled");
                            return;
                        }
                        if (location.hash == response["redirection"]) {
                            window.dispatchEvent(new HashChangeEvent("hashchange"))
                        } else {
                            window.location.href = response["redirection"];
                        }
                    } else {
                        $(".ui.error.message").html("Ocurrió un error al guardar los cambios.");
                        $(".ui.error.message").css("display", "block");
                    }
                }
            });
        }
    } else {
        $(".ui.error.message").html("Debes completar los campos requeridos y utilizar datos válidos.");
        $(".ui.error.message").css("display", "block");
        $(submitButton).removeClass("loading disabled");
    }
}
