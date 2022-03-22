@php
    use App\Enums\ClinicalRecordFieldType;
@endphp
<script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
<script>
    $(document).ready(function () {
        window.changeMenuActiveButton("#clinical_record_generator_button");
        window.menuRecord("hide");
        const MAX_NUMBER_OF_OPTIONS = 10;
        window.formFields = [];
        var formFieldsCounter = 0;
        $("#field_type_selector").dropdown();
        $("#group_selector").dropdown();
        $(".add_group_button").click(function () {
            const groupName = $(".group_name input").val();
            if (groupName.length == 0) {
                return false;
            }
            const id = Math.random();
            window.formFields.push({
                id: id,
                name: groupName,
                fields: []
            });
            $(".fields_grid").append(
                "<div class='row' data-id='" + id + "'>" +
                    "<div class='column'>" +
                        "<h3 class='ui dividing header'>" + groupName + "</h3>" +
                    "</div>" +
                "</div>"
            );
            $(".group_name input").val("");
            $("#group_selector .menu").append(
                "<div class='item' data-value='" + id + "'>" +
                    groupName +
                "</div>"
            );
        });
        $(".add_field_button").click(function () {
            const fieldName = $(".field_name input").val();
            const fieldId = $("#field_type_selector input").val();
            const groupId = $("#group_selector input").val();
            if (fieldId.length == 0 || fieldName.length == 0 || groupId.length == 0) {
                return false;
            }
            const groupIndex = window.formFields.findIndex(group => group.id == groupId);
            if (groupIndex == -1) {
                return false;
            }
            if (formFieldsCounter > 100) {
                return false;
            }
            const id = Math.random();
            if (fieldId == "{{ ClinicalRecordFieldType::INPUT_TEXT }}") {
                window.formFields[groupIndex].fields.push({
                    id: id,
                    name: fieldName,
                    type: "{{ ClinicalRecordFieldType::INPUT_TEXT }}"
                });
                $(".fields_grid").append(
                    "<div class='row' data-id='" + id + "'>" +
                        "<div class='column'>" +
                            "<div class='field'>" +
                                "<label>" + fieldName + "</label>" +
                                "<div class='ui action input'>" +
                                    "<input type='text' maxlength='500' readonly/>" +
                                    "<div class='remove_field_button ui red icon button' data-gid='" + groupIndex + "'>" +
                                        "<i class='close icon'></i>" +
                                    "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>"
                );
            } else if (fieldId == "{{ ClinicalRecordFieldType::TEXT_AREA }}") {
                window.formFields[groupIndex].fields.push({
                    id: id,
                    name: fieldName,
                    type: "{{ ClinicalRecordFieldType::TEXT_AREA }}"
                });
                $(".fields_grid").append(
                    "<div class='row' data-id='" + id + "'>" +
                        "<div class='column'>" +
                            "<div class='field'>" +
                                "<label>" + fieldName + "</label>" +
                                "<div class='ui action input'>" +
                                    "<textarea rows='3' maxlength='500' readonly></textarea>" +
                                    "<div class='remove_field_button ui red icon button' data-gid='" + groupIndex + "'>" +
                                        "<i class='close icon'></i>" +
                                    "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>"
                );
            } else if (fieldId == "{{ ClinicalRecordFieldType::DROPDOWN }}") {
                window.formFields[groupIndex].fields.push({
                    id: id,
                    name: fieldName,
                    type: "{{ ClinicalRecordFieldType::DROPDOWN }}",
                    options: []
                });
                $(".fields_grid").append(
                    "<div class='row' data-id='" + id + "'>" +
                        "<div class='column'>" +
                            "<div class='field'>" +
                                "<label>" + fieldName + "</label>" +
                                "<div class='ui buttons' style='width:100%;'>" +
                                    "<div class='crg_dropdown ui fluid multiple search selection dropdown'>" +
                                        "<input type='hidden'/>" +
                                        "<i class='dropdown icon'></i>" +
                                        "<div class='default text'>" + fieldName + "</div>" +
                                        "<div class='menu'></div>" +
                                    "</div>" +
                                    "<div class='remove_field_button ui red icon button' data-gid='" + groupIndex + "'>" +
                                        "<i class='close icon'></i>" +
                                    "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>"
                );
                const fieldIndex = window.formFields[groupIndex].fields.findIndex(field => field.id == id);
                $(".crg_dropdown").dropdown({
                    allowAdditions: true,
                    preserveHTML: false,
                    maxSelections: MAX_NUMBER_OF_OPTIONS,
                    onAdd: function (addedValue, _, _) {
                        const optionIndex = window.formFields[groupIndex].fields[fieldIndex].options.findIndex(option => option.option == addedValue);
                        if (optionIndex > -1) {
                            return false;
                        }
                        window.formFields[groupIndex].fields[fieldIndex].options.push({
                            id: Math.random(),
                            option: addedValue
                        });
                        console.log(window.formFields);
                    },
                    onLabelRemove: function (removedValue) {
                        const optionIndex = window.formFields[groupIndex].fields[fieldIndex].options.findIndex(option => option.option == removedValue);
                        if (optionIndex > -1) {
                            window.formFields[groupIndex].fields[fieldIndex].options.splice(optionIndex, 1);
                            console.log(window.formFields);
                        }
                    }
                });
            } else if (fieldId == "{{ ClinicalRecordFieldType::RADIO_BUTTONS }}" || fieldId == "{{ ClinicalRecordFieldType::CHECKBOXES }}") {
                window.formFields[groupIndex].fields.push({
                    id: id,
                    name: fieldName,
                    type: fieldId,
                    options: []
                });
                $(".fields_grid").append(
                    "<div class='row' data-id='" + id + "'>" +
                        "<div class='column'>" +
                            "<div class='field'>" +
                                "<label>" + fieldName + "</label>" +
                                "<div class='inline fields'>" +
                                "</div>" +
                                "<div class='ui action input'>" +
                                    "<input type='text' maxlength='255'/>" +
                                    "<div class='add_option_button ui green icon button' data-gid='" + groupIndex + "'>" +
                                        "<i class='plus icon'></i>" +
                                    "</div>" +
                                    "<div class='remove_field_button ui red icon button' data-gid='" + groupIndex + "'>" +
                                        "<i class='close icon'></i>" +
                                    "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>"
                );
            }
            formFieldsCounter++;
            console.log(window.formFields);
            $(".field_name input").val("");
            $("#field_type_selector").dropdown("clear");
        });
        $(".fields_grid").on("click", ".remove_field_button", function (e) {
            const row = $(e.target).closest(".row");
            const groupIndex = $(this).attr("data-gid");
            const fieldIndex = window.formFields[groupIndex].fields.findIndex(field => field.id == row.attr("data-id"));
            if (fieldIndex > -1) {
                window.formFields[groupIndex].fields.splice(fieldIndex, 1);
                formFieldsCounter--;
            }
            row.remove();
            console.log(window.formFields);
        });
        $(".fields_grid").on("click", ".add_option_button", function (e) {
            const optionName = $(this).parent().children("input").val();
            if (optionName.length == 0) {
                return false;
            }
            const rowId = $(e.target).closest(".row").attr("data-id");
            const groupIndex = $(this).attr("data-gid");
            const fieldIndex = window.formFields[groupIndex].fields.findIndex(field => field.id == rowId);
            if (window.formFields[groupIndex].fields[fieldIndex].options.length >= MAX_NUMBER_OF_OPTIONS) {
                return false;
            }
            if (window.formFields[groupIndex].fields[fieldIndex].type == "{{ ClinicalRecordFieldType::RADIO_BUTTONS }}") {
                $(e.target).closest(".field").children(".inline.fields").append(
                    "<div class='field'>" +
                        "<div class='ui radio read-only checkbox'>" +
                            "<input type='radio' readonly/>" +
                            "<label>" + optionName + "</label>" +
                        "</div>" +
                    "</div>"
                );
            } else if (window.formFields[groupIndex].fields[fieldIndex].type == "{{ ClinicalRecordFieldType::CHECKBOXES }}") {
                $(e.target).closest(".field").children(".inline.fields").append(
                    "<div class='field'>" +
                        "<div class='ui read-only checkbox'>" +
                            "<input type='checkbox' readonly/>" +
                            "<label>" + optionName + "</label>" +
                        "</div>" +
                    "</div>"
                );
            }
            window.formFields[groupIndex].fields[fieldIndex].options.push({
                id: Math.random(),
                option: optionName
            });
            $(e.target).closest(".add_option_button").parent().children("input").val("");
        });
        $(".create_clinical_record_button").click(function () {
            if (window.formFields.length == 0) {
                $(".ui.error.message").html("Debes agregar al menos 1 campo.");
                $(".ui.error.message").css("display", "block");
                return false;
            }
            saveChanges(this, false, window.formFields);
        })
    });
</script>
<div class="dashboard_page_header">
    <h3 class="ui header">@lang("dashboard.clinical_record_generator")</h3>
</div>
<br>
<form action="{{ route("dashboard_clinical_record_generator_save") }}" class="clinical_record_generator_form ui form" method="POST">
    <div class="ui blue segment">
        <div class="required field">
            <label>@lang("dashboard.name")</label>
            <input type="text" name="name" autocomplete="off" required/>
        </div>
    </div>
    <div class="fields_grid ui grid"></div>
    <br>
    <div class="ui orange segment">
        <h3 class="ui dividing header">@lang("dashboard.add_group")</h3>
        <div class="group_name ui input">
            <input type="text" placeholder="@lang("dashboard.group_name")">
        </div>
        <div class="add_group_button ui primary labeled icon button">
            <i class="plus icon"></i>
            @lang("dashboard.add_group")
        </div>
    </div>
    <div class="ui green segment">
        <h3 class="ui dividing header">@lang("dashboard.add_field")</h3>
        <div class="field_name ui input">
            <input type="text" placeholder="@lang("dashboard.field_name")">
        </div>
        <div class="ui fluid selection dropdown" id="group_selector">
            <input type="hidden"/>
            <i class="dropdown icon"></i>
            <div class="default text">@lang("dashboard.group")</div>
            <div class="menu"></div>
        </div>
        <div class="ui fluid selection dropdown" id="field_type_selector">
            <input type="hidden"/>
            <i class="dropdown icon"></i>
            <div class="default text">@lang("dashboard.field_type")</div>
            <div class="menu">
                @foreach (ClinicalRecordFieldType::$typesData as $typeId => $typeName)
                    <div class="item" data-value="{{ $typeId }}">
                        {{ ClinicalRecordFieldType::getText($typeId) }}
                    </div>
                @endforeach
            </div>
        </div>
        <div class="add_field_button ui primary labeled icon button">
            <i class="plus icon"></i>
            @lang("dashboard.add_field")
        </div>
    </div>
    <div class="ui error message"></div>
    <div class="create_clinical_record_button ui green right floated labeled icon button">
        <i class="check icon"></i>
        @lang("dashboard.create_clinical_record")
    </div>
</form>
