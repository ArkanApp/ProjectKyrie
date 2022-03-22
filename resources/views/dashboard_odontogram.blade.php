@php
$odontograms = [
    "adult" => [
        "left" => [
            ["init" => 18, "end" => 11],
            ["init" => 48, "end" => 41]
        ],
        "right" => [
            ["init" => 21, "end" => 28],
            ["init" => 31, "end" => 38]
        ]
    ],
    "kid" => [
        "left" => [
            ["init" => 55, "end" => 51],
            ["init" => 85, "end" => 81]
        ],
        "right" => [
            ["init" => 61, "end" => 65],
            ["init" => 71, "end" => 75]
        ]
    ],
    "mixed" => [
        "left" => [
            ["init" => 18, "end" => 11],
            ["init" => 55, "end" => 51],
            ["init" => 85, "end" => 81],
            ["init" => 48, "end" => 41]
        ],
        "right" => [
            ["init" => 21, "end" => 28],
            ["init" => 61, "end" => 65],
            ["init" => 71, "end" => 75],
            ["init" => 31, "end" => 38]
        ]
    ]
];
@endphp
<script src="{{ asset('js/forms.min.js') }}?v=1.0"></script>
<script>
    $(document).ready(function () {
        window.hashArguments[0] = "{{ $patient->patient_id }}";
        window.menuRecord("show");
        window.changeMenuActiveButton("#odontogram_button");
        $(".ui.accordion").accordion({
            exclusive: false
        });
        $(".ui.dropdown").dropdown({
            preserveHTML: false
        }).dropdown("clear");
        $(".ui.checkbox").checkbox();
    });
</script>
<div id="add_disease_modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">@lang("dashboard.add_disease")</div>
    <div class="content">
        <div class="ui clearing segment">
            <form action="{{ route("dashboard_odontogram_add_disease", ["patient_id" => $patient->patient_id]) }}" class="add_disease_form ui form" method="POST">
                @csrf
                <input type="hidden" name="tooth_number" required/>
                <input type="hidden" name="tooth_selected_faces" required/>
                <div class="ui fluid styled accordion">
                    <div class="title">
                        <i class="dropdown icon"></i>
                        Cara
                    </div>
                    <div class="content">
                        <div class="ui equal width grid">
                            <div class="row">
                                <div class="four wide column">
                                    <div class="odontogram_tooth interactive">
                                        <svg class="odontogram_tooth_paths">
                                            <path class="odontogram_tooth_path tooth_top" d="M 0 0 L 54 0 L 36 18 L 18 18 L 0 0 Z" data-face="top" onclick="selectToothFace(this);"></path>
                                            <path class="odontogram_tooth_path tooth_left" d="M 0 0 L 18 18 L 18 36 L 0 54 L 0 0 Z" data-face="left" onclick="selectToothFace(this);"></path>
                                            <path class="odontogram_tooth_path tooth_bottom" d="M 0 54 L 54 54 L 36 36 L 18 36 L 0 54 Z" data-face="bottom" onclick="selectToothFace(this);"></path>
                                            <path class="odontogram_tooth_path tooth_right" d="M 36 18 L 54 0 L 54 54 L 36 36 L 36 18 Z" data-face="right" onclick="selectToothFace(this);"></path>
                                            <path class="odontogram_tooth_path tooth_center" d="M 18 36 L 36 36 L 36 18 L 18 18 L 18 36 Z" data-face="center" onclick="selectToothFace(this);"></path>
                                        </svg>
                                        <div class="tooth_number">0</div>
                                        <div class="inline field">
                                            <div class="ui checkbox" onclick="onSelectCervicalFaceOdontogram(this);">
                                                <input type="checkbox" tabindex="0" class="hidden"/>
                                                <label>@lang("dashboard.select_cervical_face")</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="optional field">
                                        <label>@lang("dashboard.diseases")</label>
                                        <div class="ui multiple search selection dropdown" id="tooth_face_diseases_dropdown">
                                            <input type="hidden" name="tooth_face_diseases" required/>
                                            <i class="dropdown icon"></i>
                                            <div class="default text">@lang("dashboard.diseases")</div>
                                            <div class="menu">
                                                @foreach ($toothFaceDiseasesEnum as $toothFaceDiseaseId => $toothFaceDiseaseName)
                                                    <div class="item" data-value="{{ $toothFaceDiseaseId }}">
                                                        {{ App\Enums\ToothFaceDisease::getText($toothFaceDiseaseId) }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title">
                        <i class="dropdown icon"></i>
                        Diente
                    </div>
                    <div class="content">
                        <div class="optional field">
                            <label>@lang("dashboard.diseases")</label>
                            <div class="ui multiple search selection dropdown" id="tooth_diseases_dropdown">
                                <input type="hidden" name="tooth_diseases" required/>
                                <i class="dropdown icon"></i>
                                <div class="default text">@lang("dashboard.diseases")</div>
                                <div class="menu">
                                    @foreach ($toothDiseasesEnum as $toothDiseaseId => $toothDiseaseName)
                                        <div class="item" data-value="{{ $toothDiseaseId }}">
                                            {{ App\Enums\ToothDisease::getText($toothDiseaseId) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui error message"></div><br>
                <div class="ui black right floated deny button" onclick="$('#add_disease_modal').modal('hide');">
                    @lang("dashboard.close")
                </div>
                <button class="ui positive right floated labeled icon button" type="submit" onclick="saveChanges(this, false, {o_type: '{{ $odontogramType }}'});">
                    <i class="check icon"></i>
                    @lang("dashboard.add_disease")
                </button>
            </form>
        </div>
    </div>
</div>
<div class="dashboard_page_header">
    <h2 class="ui header">@lang("dashboard.odontogram")</h2>
</div>
<span class="ui red medium text">@lang("dashboard.odontogram_instructions")</span>
<br><br>
<div class="ui buttons">
    <a href="#patient/{{ $patient->patient_id }}/odontogram/adult" class="ui primary {{ $odontogramType == "adult" ? "active " : "" }}button">@lang("dashboard.adult")</a>
    <a href="#patient/{{ $patient->patient_id }}/odontogram/kid" class="ui primary {{ $odontogramType == "kid" ? "active " : "" }}button">@lang("dashboard.kid")</a>
    <a href="#patient/{{ $patient->patient_id }}/odontogram/mixed" class="ui primary {{ $odontogramType == "mixed" ? "active " : "" }}button">@lang("dashboard.mixed")</a>
</div>
<div class="odontogram ui two column stackable grid">
    <div class="row">
        @foreach ($odontograms[$odontogramType] as $side => $sideValues)
            <div class="column">
                <div class="odontogram_side {{ $side . "_side" }} ui stackable grid">
                    @foreach ($sideValues as $rowValues)
                        <div class="row">
                            <div class="column">
                                @for ($i = $rowValues["init"]; $side == "left" ? $i >= $rowValues["end"] : $i <= $rowValues["end"]; $side == "left" ? $i-- : $i++)
                                    <div class="odontogram_tooth" data-tooth="{{ $i }}" onclick="showAddDiseaseModal(this);">
                                        <svg class="odontogram_tooth_paths" viewBox="0 0 54 54">
                                            @if (array_filter($toothDiseasesArray, function ($toothDisease) use ($i) {
                                                return $toothDisease->tooth_number == $i && (
                                                    $toothDisease->disease == App\Enums\ToothDisease::MISSING_TOOTH || 
                                                    $toothDisease->disease == App\Enums\ToothDisease::CLINICALLY_MISSING_TOOTH
                                                );
                                            }))
                                                <path class="odontogram_tooth_path tooth disease missing_tooth tooth_top" d="M 0 0 L 54 0 L 36 18 L 18 18 L 0 0 Z"></path>
                                                <path class="odontogram_tooth_path tooth disease missing_tooth tooth_left" d="M 0 0 L 18 18 L 18 36 L 0 54 L 0 0 Z"></path>
                                                <path class="odontogram_tooth_path tooth disease missing_tooth tooth_bottom" d="M 0 54 L 54 54 L 36 36 L 18 36 L 0 54 Z"></path>
                                                <path class="odontogram_tooth_path tooth disease missing_tooth tooth_right" d="M 36 18 L 54 0 L 54 54 L 36 36 L 36 18 Z"></path>
                                                <path class="odontogram_tooth_path tooth disease missing_tooth tooth_center" d="M 18 36 L 36 36 L 36 18 L 18 18 L 18 36 Z"></path>
                                                <path class="odontogram_tooth_path shape disease missing_tooth" d="M 0 0 L 54 54 Z"></path>
                                            @else
                                                <path class="odontogram_tooth_path tooth_top{{ 
                                                    array_key_exists($i, $toothFaceOdontograms) && in_array("top", $toothFaceOdontograms[$i]["facesWithDiseases"]) ? " active" : ""
                                                }}" d="M 0 0 L 54 0 L 36 18 L 18 18 L 0 0 Z"></path>
                                                <path class="odontogram_tooth_path tooth_left{{ 
                                                    array_key_exists($i, $toothFaceOdontograms) && in_array("left", $toothFaceOdontograms[$i]["facesWithDiseases"]) ? " active" : ""
                                                }}" d="M 0 0 L 18 18 L 18 36 L 0 54 L 0 0 Z"></path>
                                                <path class="odontogram_tooth_path tooth_bottom{{ 
                                                    array_key_exists($i, $toothFaceOdontograms) && in_array("bottom", $toothFaceOdontograms[$i]["facesWithDiseases"]) ? " active" : ""
                                                }}" d="M 0 54 L 54 54 L 36 36 L 18 36 L 0 54 Z"></path>
                                                <path class="odontogram_tooth_path tooth_right{{ 
                                                    array_key_exists($i, $toothFaceOdontograms) && in_array("right", $toothFaceOdontograms[$i]["facesWithDiseases"]) ? " active" : ""
                                                }}" d="M 36 18 L 54 0 L 54 54 L 36 36 L 36 18 Z"></path>
                                                <path class="odontogram_tooth_path tooth_center{{ 
                                                    array_key_exists($i, $toothFaceOdontograms) && in_array("center", $toothFaceOdontograms[$i]["facesWithDiseases"]) ? " active" : ""
                                                }}" d="M 18 36 L 36 36 L 36 18 L 18 18 L 18 36 Z"></path>
                                            @endif
                                        </svg>
                                        <div class="tooth_number">{{ $i }}</div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
<h3>@lang("dashboard.tooth_face_records")</h3>
<span class="ui red medium text">@lang("dashboard.ordered_by_desc")</span>
<table class="ui unstackable padded striped celled table">
    <thead>
        <tr>
            <th>@lang("dashboard.register_date")</th>
            <th>@lang("dashboard.tooth")</th>
            <th>@lang("dashboard.faces")</th>
            <th>@lang("dashboard.disease")</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($toothFaceDiseases as $toothFaceDiseaseData)
            @php
                $toothFaceDisease = App\ToothFaceDisease::find($toothFaceDiseaseData->tooth_face_disease_id);
            @endphp
            <tr>
                <td>{{ $toothFaceDisease->getRegisterDate() }}</td>
                <td>{{ $toothFaceDiseaseData->tooth_number }}</td>
                <td>
                    <div class="ui list">
                        @foreach ($toothFaceDisease->getFaces() as $face)
                            <div class="item">
                                <i class="right angle icon"></i>
                                <div class="content">{{ $face }}</div>
                            </div>
                        @endforeach
                    </div>
                </td>
                <td>{{ $toothFaceDisease->getDisease() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<h3>@lang("dashboard.tooth_records")</h3>
<span class="ui red medium text">@lang("dashboard.ordered_by_desc")</span>
<table class="ui unstackable padded striped celled table">
    <thead>
        <tr>
            <th>@lang("dashboard.register_date")</th>
            <th>@lang("dashboard.tooth")</th>
            <th>@lang("dashboard.disease")</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($toothDiseases as $toothDiseaseData)
            @php
                $toothDisease = App\ToothDisease::find($toothDiseaseData->tooth_disease_id);
            @endphp
            <tr>
                <td>{{ $toothDisease->getRegisterDate() }}</td>
                <td>{{ $toothDiseaseData->tooth_number }}</td>
                <td>{{ $toothDisease->getDisease() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
