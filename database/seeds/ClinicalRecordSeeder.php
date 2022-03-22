<?php

use App\ClinicalRecord;
use App\ClinicalRecordField;
use App\ClinicalRecordFieldGroup;
use App\ClinicalRecordFieldOption;
use Illuminate\Database\Seeder;

class ClinicalRecordSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->adultClinicHistory();
        $this->informedConsents();
        $this->medicalQuestionnaire();
        $this->orthodonticsATM();
        $this->phase1Systemic();
        $this->phase2nonDentalPremises();
        $this->phase3Conditioning();
        $this->phase4rehabilitation();
        $this->phase5tracing();
        $this->orthodonticsClinicalExploration();
        $this->orthodonticsDxAndTx();
        $this->comprehensiveDiagnosis();
        $this->riskPeriodontalDisease();
        $this->radiographicFindings();
        $this->physicalExam();
        $this->formCariesRisk();
        // $this->cancerRiskFormatAndScore();
    }

    public function adultClinicHistory() {
        $adultClinicalHistory = new ClinicalRecord();
        $adultClinicalHistory->name = "Historia Clínica de Adulto";
        $adultClinicalHistory->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $adultClinicalHistory->clinical_record_id;
        $group1->title = "Motivos";
        $group1->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field1->title = "Motivo de la consulta";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();

        $group2 = new ClinicalRecordFieldGroup();
        $group2->clinical_record_id = $adultClinicalHistory->clinical_record_id;
        $group2->title = "Padecimiento actual bucal";
        $group2->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group2->clinical_record_field_group_id;
        $field1->title = "Padecimiento actual bucal";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();

        $group3 = new ClinicalRecordFieldGroup();
        $group3->clinical_record_id = $adultClinicalHistory->clinical_record_id;
        $group3->title = "Antecedentes heredo familiares";
        $group3->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group3->clinical_record_field_group_id;
        $field1->title = "Diabéticos, tuberculosos, neoplásicos, cardiovasculares, luéticos";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();

        $group4 = new ClinicalRecordFieldGroup();
        $group4->clinical_record_id = $adultClinicalHistory->clinical_record_id;
        $group4->title = "Antecedentes personales no patológicos";
        $group4->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group4->clinical_record_field_group_id;
        $field1->title = "Lugar de origen, residencia actual, servicios de vivienda (agua, luz, drenaje), 
            higiene general, higiene oral, adicciones, práctica de deportes";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();

        $group5 = new ClinicalRecordFieldGroup();
        $group5->clinical_record_id = $adultClinicalHistory->clinical_record_id;
        $group5->title = "Antecedentes personales patológicos";
        $group5->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group5->clinical_record_field_group_id;
        $field1->title = "Cardiovascular, respiratorio, digestivo, endócrinos, alérgicos, sanguíneos u otros";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();

        $field2 = new ClinicalRecordField();
        $field2->clinical_record_field_group_id = $group5->clinical_record_field_group_id;
        $field2->title = "Interacciones medicamentosas";
        $field2->type = 1;
        $field2->has_multiple_options = false;
        $field2->save();

        $group6 = new ClinicalRecordFieldGroup();
        $group6->clinical_record_id = $adultClinicalHistory->clinical_record_id;
        $group6->title = "Revisión de aparatos y sistemas";
        $group6->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group6->clinical_record_field_group_id;
        $field1->title = "Signos, síntomas";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();

        $group7 = new ClinicalRecordFieldGroup();
        $group7->clinical_record_id = $adultClinicalHistory->clinical_record_id;
        $group7->title = "Historia dental";
        $group7->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group7->clinical_record_field_group_id;
        $field1->title = "Limpieza, extracciones, endodoncia, prótesis fija, ortodoncia u otros";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();
    }

    public function informedConsents() {
        $informedConsents = new ClinicalRecord();
        $informedConsents->name = "Consentimientos informados";
        $informedConsents->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $informedConsents->clinical_record_id;
        $group1->title = "Consentimientos";
        $group1->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field1->title = "Descripción";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();
    }

    public function medicalQuestionnaire() {
        $medicalQuestionnaire = new ClinicalRecord();
        $medicalQuestionnaire->name = "Cuestionario de salud";
        $medicalQuestionnaire->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $medicalQuestionnaire->clinical_record_id;
        $group1->title = "¿Ha tenido o ha sido tratado de lo siguiente?";
        $group1->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field1->title = "Hepatitis, ictericia o problemas con el hígado";
        $field1->type = 3;
        $field1->has_multiple_options = true;
        $field1->save();
        $this->createBooleanOptions($field1->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field2 = new ClinicalRecordField();
        $field2->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field2->title = "Ataque cardiaco";
        $field2->type = 3;
        $field2->has_multiple_options = true;
        $field2->save();
        $this->createBooleanOptions($field2->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field3 = new ClinicalRecordField();
        $field3->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field3->title = "Embolia o derrame cerebral";
        $field3->type = 3;
        $field3->has_multiple_options = true;
        $field3->save();
        $this->createBooleanOptions($field3->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field4 = new ClinicalRecordField();
        $field4->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field4->title = "Presión alta o hipertensión";
        $field4->type = 3;
        $field4->has_multiple_options = true;
        $field4->save();
        $this->createBooleanOptions($field4->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field5 = new ClinicalRecordField();
        $field5->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field5->title = "Soplos cardiacos o sonidos anormales del corazón";
        $field5->type = 3;
        $field5->has_multiple_options = true;
        $field5->save();
        $this->createBooleanOptions($field5->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field6 = new ClinicalRecordField();
        $field6->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field6->title = "Problemas del corazón o palpaciones";
        $field6->type = 3;
        $field6->has_multiple_options = true;
        $field6->save();
        $this->createBooleanOptions($field6->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field7 = new ClinicalRecordField();
        $field7->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field7->title = "Fiebre reumática";
        $field7->type = 3;
        $field7->has_multiple_options = true;
        $field7->save();
        $this->createBooleanOptions($field7->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field8 = new ClinicalRecordField();
        $field8->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field8->title = "Transfusiones de sangre";
        $field8->type = 3;
        $field8->has_multiple_options = true;
        $field8->save();
        $this->createBooleanOptions($field8->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field9 = new ClinicalRecordField();
        $field9->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field9->title = "Anemia";
        $field9->type = 3;
        $field9->has_multiple_options = true;
        $field9->save();
        $this->createBooleanOptions($field9->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field10 = new ClinicalRecordField();
        $field10->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field10->title = "Sangrado excesivo, sangrado nasal o moretones";
        $field10->type = 3;
        $field10->has_multiple_options = true;
        $field10->save();
        $this->createBooleanOptions($field10->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field11 = new ClinicalRecordField();
        $field11->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field11->title = "Dolores de pecho o angina";
        $field11->type = 3;
        $field11->has_multiple_options = true;
        $field11->save();
        $this->createBooleanOptions($field11->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field12 = new ClinicalRecordField();
        $field12->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field12->title = "Desmayos, convulsiones, epilepsia, ataques";
        $field12->type = 3;
        $field12->has_multiple_options = true;
        $field12->save();
        $this->createBooleanOptions($field12->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field13 = new ClinicalRecordField();
        $field13->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field13->title = "Problemas mentales y/o emocionales";
        $field13->type = 3;
        $field13->has_multiple_options = true;
        $field13->save();
        $this->createBooleanOptions($field13->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field14 = new ClinicalRecordField();
        $field14->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field14->title = "Radiciones o tratamientos con cáncer";
        $field14->type = 3;
        $field14->has_multiple_options = true;
        $field14->save();
        $this->createBooleanOptions($field14->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field15 = new ClinicalRecordField();
        $field15->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field15->title = "Tuberculosis o vivido con una persona con tuberculosis";
        $field15->type = 3;
        $field15->has_multiple_options = true;
        $field15->save();
        $this->createBooleanOptions($field15->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field16 = new ClinicalRecordField();
        $field16->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field16->title = "Tos constante o tos con sangre";
        $field16->type = 3;
        $field16->has_multiple_options = true;
        $field16->save();
        $this->createBooleanOptions($field16->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field17 = new ClinicalRecordField();
        $field17->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field17->title = "Asma o dificultad para respirar";
        $field17->type = 3;
        $field17->has_multiple_options = true;
        $field17->save();
        $this->createBooleanOptions($field17->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field18 = new ClinicalRecordField();
        $field18->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field18->title = "Enfermedad venérea o sífilis";
        $field18->type = 3;
        $field18->has_multiple_options = true;
        $field18->save();
        $this->createBooleanOptions($field18->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field19 = new ClinicalRecordField();
        $field19->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field19->title = "Bocio o problemas tiroideos";
        $field19->type = 3;
        $field19->has_multiple_options = true;
        $field19->save();
        $this->createBooleanOptions($field19->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field20 = new ClinicalRecordField();
        $field20->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field20->title = "Enfermedad del riñón";
        $field20->type = 3;
        $field20->has_multiple_options = true;
        $field20->save();
        $this->createBooleanOptions($field20->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field21 = new ClinicalRecordField();
        $field21->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field21->title = "Úlcera péptica";
        $field21->type = 3;
        $field21->has_multiple_options = true;
        $field21->save();
        $this->createBooleanOptions($field21->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field22 = new ClinicalRecordField();
        $field22->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field22->title = "Diabetes";
        $field22->type = 3;
        $field22->has_multiple_options = true;
        $field22->save();
        $this->createBooleanOptions($field22->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field23 = new ClinicalRecordField();
        $field23->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field23->title = "Buena condición de salud";
        $field23->type = 3;
        $field23->has_multiple_options = true;
        $field23->save();
        $this->createBooleanOptions($field23->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field24 = new ClinicalRecordField();
        $field24->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field24->title = "Ha visitado a su médico en los últimos 6 meses";
        $field24->type = 3;
        $field24->has_multiple_options = true;
        $field24->save();
        $this->createBooleanOptions($field24->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field25 = new ClinicalRecordField();
        $field25->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field25->title = "Ha sido hospitalizado";
        $field25->type = 3;
        $field25->has_multiple_options = true;
        $field25->save();
        $this->createBooleanOptions($field25->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field26 = new ClinicalRecordField();
        $field26->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field26->title = "Ha estado tomando medicina en los últimos 6 meses";
        $field26->type = 3;
        $field26->has_multiple_options = true;
        $field26->save();
        $this->createBooleanOptions($field26->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field27 = new ClinicalRecordField();
        $field27->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field27->title = "Ha tenido algún otro problema médico";
        $field27->type = 3;
        $field27->has_multiple_options = true;
        $field27->save();
        $this->createBooleanOptions($field27->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field28 = new ClinicalRecordField();
        $field28->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field28->title = "Es alérgico a medicinas";
        $field28->type = 3;
        $field28->has_multiple_options = true;
        $field28->save();
        $this->createBooleanOptions($field28->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field29 = new ClinicalRecordField();
        $field29->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field29->title = "Tiene alérgia, sensibilidad o intolerancia a algo";
        $field29->type = 3;
        $field29->has_multiple_options = true;
        $field29->save();
        $this->createBooleanOptions($field29->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field30 = new ClinicalRecordField();
        $field30->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field30->title = "Está o hay posibilidades de que esté embarazada";
        $field30->type = 3;
        $field30->has_multiple_options = true;
        $field30->save();
        $this->createBooleanOptions($field30->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field31 = new ClinicalRecordField();
        $field31->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field31->title = "Utiliza fármacos o drogas habitualmente";
        $field31->type = 3;
        $field31->has_multiple_options = true;
        $field31->save();
        $this->createBooleanOptions($field31->clinical_record_field_id, $group1->clinical_record_field_group_id);

        $field32 = new ClinicalRecordField();
        $field32->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field32->title = "Nombre de su médico, teléfono, correo electrónico, dirección";
        $field32->type = 1;
        $field32->has_multiple_options = false;
        $field32->save();

        $group2 = new ClinicalRecordFieldGroup();
        $group2->clinical_record_id = $medicalQuestionnaire->clinical_record_id;
        $group2->title = "Caracterización de la enfermedad";
        $group2->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group2->clinical_record_field_group_id;
        $field1->title = "Descripción";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();
    }

    public function orthodonticsATM() {
        $orthodonticsATM = new ClinicalRecord();
        $orthodonticsATM->name = "Ortodoncia ATM";
        $orthodonticsATM->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $orthodonticsATM->clinical_record_id;
        $group1->title = "A rellenar exclusivamente por el ortodoncista";
        $group1->save();
        $this->createBooleanField($group1->clinical_record_field_group_id, "Tratamiento previo de ortodoncia", true);

        $group2 = new ClinicalRecordFieldGroup();
        $group2->clinical_record_id = $orthodonticsATM->clinical_record_id;
        $group2->title = "Enfermedades conocidas";
        $group2->save();
        $this->createBooleanField($group2->clinical_record_field_group_id, "Padecimientos de la infancia");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Malformaciones congénitas");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Hipertensión arterial");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Intervenciones quirúrgicas");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Medicamentos");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Fiebre reumática");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Adeniodes");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Hepatitis");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Rinitis");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Succión dedo");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Alergias");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Transfusiones");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Diabetes");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Hérpes");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Succión chupete");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Hemorrágias");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Traumatismos");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Asma");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Embarazo");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Bruxismo", true);

        $group3 = new ClinicalRecordFieldGroup();
        $group3->clinical_record_id = $orthodonticsATM->clinical_record_id;
        $group3->title = "Anamnesis";
        $group3->save();
        $this->createCheckboxesField($group3->clinical_record_field_group_id, "¿Ha padecido traumatismo en alguna zona de la cara?", [
            "Limitación funcional", "Ruidos", "Traumatismo"
        ]);
        $this->createInputTextField($group3->clinical_record_field_group_id, "Especifique");
        $this->createCheckboxesField($group3->clinical_record_field_group_id, "¿Ha tenido dolor en alguna de estas zonas?", [
            "Cuello", "Cara", "Cabeza"
        ]);
        $this->createInputTextField($group3->clinical_record_field_group_id, "Especifique");
        $this->createBooleanField($group3->clinical_record_field_group_id, "¿Ha tomado algún medicamento?", true, "Especifique");
        $this->createBooleanField($group3->clinical_record_field_group_id, "¿Está pasando por algún momento de estrés?", true, "Especifique");

        $group4 = new ClinicalRecordFieldGroup();
        $group4->clinical_record_id = $orthodonticsATM->clinical_record_id;
        $group4->title = "Palpación muscular";
        $group4->save();
        $this->createCheckboxesField($group4->clinical_record_field_group_id, "Lado derecho", [
            "Dolor", "Sensible"
        ]);
        $this->createInputTextField($group4->clinical_record_field_group_id, "Especifique");
        $this->createCheckboxesField($group4->clinical_record_field_group_id, "Lado izquierdo", [
            "Dolor", "Sensible"
        ]);
        $this->createInputTextField($group4->clinical_record_field_group_id, "Especifique");
        
        $group5 = new ClinicalRecordFieldGroup();
        $group5->clinical_record_id = $orthodonticsATM->clinical_record_id;
        $group5->title = "Examen clínico";
        $group5->save();
        $this->createBooleanField($group5->clinical_record_field_group_id, "Laxitud ligamentosa sistémica", true, "Si su respuesta es afirmativa, especificar grado");
        $this->createDropdownField($group5->clinical_record_field_group_id, "Manipulación mandibular", ["Fácil", "Término medio", "Difícil", "Muy difícil"]);
        $this->createDropdownField($group5->clinical_record_field_group_id, "Cierre labial", ["No forzado", "Levemente forzado", "Forzado"]);
        $this->createDropdownField($group5->clinical_record_field_group_id, "Labio superior", ["Normal", "Corto"]);
        $this->createBooleanField($group5->clinical_record_field_group_id, "Hipertrofia muscular");

        $group6 = new ClinicalRecordFieldGroup();
        $group6->clinical_record_id = $orthodonticsATM->clinical_record_id;
        $group6->title = "Mapa del dolor articular";
        $group6->save();
        $this->createCheckboxesField($group6->clinical_record_field_group_id, "Lado derecho", [
            "1. Sinovial anteroinferior", "2. Sinovial anterosuperior", "3. Ligamento colateral lateral",
            "4. Ligamento temporomandibular", "5. Sinovial postero-inferior", "6. Sinovial postero-superior",
            "7. Ligamento posterior", "8. Retro disco"
        ]);
        $this->createCheckboxesField($group6->clinical_record_field_group_id, "Lado izquierdo", [
            "1. Sinovial anteroinferior", "2. Sinovial anterosuperior", "3. Ligamento colateral lateral",
            "4. Ligamento temporomandibular", "5. Sinovial postero-inferior", "6. Sinovial postero-superior",
            "7. Ligamento posterior", "8. Retro disco"
        ]);
        $this->createInputTextField($group4->clinical_record_field_group_id, "Especifique");

        $group7 = new ClinicalRecordFieldGroup();
        $group7->clinical_record_id = $orthodonticsATM->clinical_record_id;
        $group7->title = "Examen dinámica mandibular (bajo presión craneal a nivel del ángulo goniaco)";
        $group7->save();
        $this->createCheckboxesField($group6->clinical_record_field_group_id, "Protusión", [
            "Ruido ATM izquierda", "Ruido ATM derecha", "Deflectiva", "Aumentada", "Disminuida", "Normal"
        ]);
        $this->createInputTextField($group6->clinical_record_field_group_id, "Especifique");
        $this->createCheckboxesField($group6->clinical_record_field_group_id, "Lateralidad derecha", [
            "Ruido ATM izquierda", "Ruido ATM derecha", "Deflectiva", "Aumentada", "Disminuida", "Normal"
        ]);
        $this->createInputTextField($group6->clinical_record_field_group_id, "Especifique");
        $this->createCheckboxesField($group6->clinical_record_field_group_id, "Lateralidad izquierda", [
            "Ruido ATM izquierda", "Ruido ATM derecha", "Deflectiva", "Aumentada", "Disminuida", "Normal"
        ]);
        $this->createInputTextField($group6->clinical_record_field_group_id, "Especifique");
        $this->createCheckboxesField($group6->clinical_record_field_group_id, "Apertura", [
            "Ruido ATM izquierda", "Ruido ATM derecha", "Deflectiva", "Aumentada", "Disminuida", "Normal"
        ]);
        $this->createInputTextField($group6->clinical_record_field_group_id, "Especifique");
        $this->createTextAreaField($group6->clinical_record_field_group_id, "Salto articular derecha (mm)");
        $this->createTextAreaField($group6->clinical_record_field_group_id, "Salto articular izquierda (mm)");


        $group8 = new ClinicalRecordFieldGroup();
        $group8->clinical_record_id = $orthodonticsATM->clinical_record_id;
        $group8->title = "Examen básico oclusal";
        $group8->save();
        $this->createBooleanField($group8->clinical_record_field_group_id, "¿Coincide mic con rc?", true);
        $this->createBooleanField($group8->clinical_record_field_group_id, "¿Facetas de desgaste?", true);
        $this->createBooleanField($group8->clinical_record_field_group_id, "¿Guía anterior con desoclusión posterior?", true);
        $this->createBooleanField($group8->clinical_record_field_group_id, "¿Guía canina lado derecho?", true);
        $this->createBooleanField($group8->clinical_record_field_group_id, "¿Guía canina lado izquierdo?", true);
        $this->createBooleanField($group8->clinical_record_field_group_id, "¿Línea media dentaria centrada?", true);
        $this->createBooleanField($group8->clinical_record_field_group_id, "¿Línea media esquelética centrada?", true);

        $group9 = new ClinicalRecordFieldGroup();
        $group9->clinical_record_id = $orthodonticsATM->clinical_record_id;
        $group9->title = "Hipótesis diagnóstica";
        $group9->save();
        $this->createBooleanField($group9->clinical_record_field_group_id, "Origen articular");
        $this->createBooleanField($group9->clinical_record_field_group_id, "Origen tejido conectivo");
        $this->createBooleanField($group9->clinical_record_field_group_id, "Origen muscular");
        $this->createBooleanField($group9->clinical_record_field_group_id, "Origen esquelético");
        $this->createBooleanField($group9->clinical_record_field_group_id, "Origen sistémico");
        $this->createBooleanField($group9->clinical_record_field_group_id, "Origen tensional");
        $this->createBooleanField($group9->clinical_record_field_group_id, "Origen oclusal", true, "Otros");
    }

    private function orthodonticsClinicalExploration() {
        $orthodonticsClinicalExploration = new ClinicalRecord();
        $orthodonticsClinicalExploration->name = "Ortodoncia Exploración Clínica";
        $orthodonticsClinicalExploration->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group1->title = "Examen extraoral frontal en reposo";
        $group1->save();
        $this->createDropdownField($group1->clinical_record_field_group_id, "Tipo facial", ["Mesofacial", "Dólicofacial", "Braquifacial"]);
        $this->createDropdownField($group1->clinical_record_field_group_id, "Tercio inferior", ["Mesofacial", "Dólicofacial", "Braquifacial"]);
        $this->createCheckboxesField($group1->clinical_record_field_group_id, "Simetría", [
            "Presente", "Derecha", "Izquierda", "Desviación mandibular esquelética", "Desviación mandibular funcional"
        ]);
        $this->createInputTextField($group1->clinical_record_field_group_id, "Especifique");
        $this->createDropdownField($group1->clinical_record_field_group_id, "Balance muscular", ["Normal", "Hipertonicidad", "Hipotonicidad"]);
        $this->createBooleanField($group1->clinical_record_field_group_id, "Labios en reposo competentes", true, "Labios en reposo incompetentes (mm) separación");
        $this->createDropdownField($group1->clinical_record_field_group_id, "Cierre labial", ["Forzado", "Levemente forzado", "No forzado"]);
        $this->createInputTextField($group1->clinical_record_field_group_id, "Exposición de incisivo en reposo (mm)");

        $group2 = new ClinicalRecordFieldGroup();
        $group2->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group2->title = "Examen extraoral frontal en sonrisa";
        $group2->save();
        $this->createBooleanField($group2->clinical_record_field_group_id, "Lmds/lmf coincidentes", true, "Desviación lmds(mm)");
        $this->createDropdownField($group2->clinical_record_field_group_id, "Dirección", ["Izquierda", "Derecha"]);
        $this->createInputTextField($group2->clinical_record_field_group_id, "Inclinación lmds (mm)");
        $this->createDropdownField($group2->clinical_record_field_group_id, "Dirección", ["Izquierda", "Derecha"]);
        $this->createDropdownField($group2->clinical_record_field_group_id, "Tipo de sonrisa", [
            "Invertida", "Plana", "Consonante", "Plena", "Estrecha"
        ]);
        $this->createDropdownField($group2->clinical_record_field_group_id, "Corredores bucales", [
            "Normales", "Aumentados", "Disminuidos", "Simétricos", "Asimétricos"
        ]);
        $this->createInputTextField($group2->clinical_record_field_group_id, "Exposición de incisivo en reposo (mm)");
        
        $group3 = new ClinicalRecordFieldGroup();
        $group3->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group3->title = "Examen extraoral perfil";
        $group3->save();
        $this->createDropdownField($group3->clinical_record_field_group_id, "Tipo perfil", [
            "Recto", "Convexo", "Cóncavo", "Escalonado"
        ]);
        $this->createDropdownField($group3->clinical_record_field_group_id, "Ángulo nasolabial", [
            "Normal", "Abierto", "Cerrado"
        ]);
        $this->createDropdownField($group3->clinical_record_field_group_id, "Surco mentolabial", [
            "Normal", "Abierto", "Cerrado"
        ]);
        $this->createDropdownField($group3->clinical_record_field_group_id, "Posición labio superior", [
            "Normal", "Protruido", "Retruido"
        ]);
        $this->createDropdownField($group3->clinical_record_field_group_id, "Grosor labio superior", [
            "Normal", "Grueso", "Delgado"
        ]);
        $this->createDropdownField($group3->clinical_record_field_group_id, "Posición labio inferior", [
            "Normal", "Protruido", "Retruido"
        ]);
        $this->createDropdownField($group3->clinical_record_field_group_id, "Grosor labio inferior", [
            "Normal", "Grueso", "Delgado"
        ]);
        $this->createDropdownField($group3->clinical_record_field_group_id, "Posición mentón", [
            "Normal", "Protusivo", "Recesivo"
        ]);

        $group4 = new ClinicalRecordFieldGroup();
        $group4->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group4->title = "Análisis dental";
        $group4->save();
        $this->createDropdownField($group4->clinical_record_field_group_id, "Tipo de dentición", [
            "Primaria", "Mixta", "Permanente"
        ]);
        $this->createDropdownField($group4->clinical_record_field_group_id, "Patrón eruptivo", [
            "Normal", "Temprano", "Tardío", "No aplica"
        ]);
        $this->createDropdownField($group4->clinical_record_field_group_id, "Alteraciones de número", [
            "Hipodoncia", "Hiperdoncia", "Retención prolongada", "Pérdida prematura"
        ]);
        $this->createTextAreaField($group4->clinical_record_field_group_id, "Otra. Especifique");
        $this->createDropdownField($group4->clinical_record_field_group_id, "Alteraciones de tamaño", [
            "Microdoncia", "Macrodoncia"
        ]);
        $this->createTextAreaField($group4->clinical_record_field_group_id, "Otra. Especifique");
        $this->createDropdownField($group4->clinical_record_field_group_id, "Alteraciones de forma", [
            "Fracturas", "Cíngulo hipertrófico", "Dientes conoides"
        ]);
        $this->createTextAreaField($group4->clinical_record_field_group_id, "Otra. Especifique");
        $this->createDropdownField($group4->clinical_record_field_group_id, "Patología dental", [
            "Caries", "Prótesis", "Restauraciones"
        ]);
        $this->createTextAreaField($group4->clinical_record_field_group_id, "Otra. Especifique");
        $this->createDropdownField($group4->clinical_record_field_group_id, "Pigmentación dental", [
            "Fluorosis", "Descalcificación"
        ]);
        $this->createTextAreaField($group4->clinical_record_field_group_id, "Especifique");
        $this->createDropdownField($group4->clinical_record_field_group_id, "Facetas de desgaste", [
            "Presentes", "Ausentes"
        ]);
        $this->createTextAreaField($group4->clinical_record_field_group_id, "Especifique");

        $group5 = new ClinicalRecordFieldGroup();
        $group5->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group5->title = "Análisis gingival";
        $group5->save();
        $this->createDropdownField($group5->clinical_record_field_group_id, "Salud periodontal", [
            "Sano", "Gingivitis", "Periodontitis", "Activa", "Pasiva"
        ]);
        $this->createDropdownField($group5->clinical_record_field_group_id, "Higiene bucal", [
            "Excelente", "Muy buena", "Aceptable", "Mediocre", "Mala"
        ]);
        $this->createDropdownField($group5->clinical_record_field_group_id, "Frenillo superior", [
            "Normal", "Hipertrófico"
        ]);
        $this->createDropdownField($group5->clinical_record_field_group_id, "Recesiones gingivales", [
            "Ausentes", "Presentes"
        ]);
        $this->createTextAreaField($group5->clinical_record_field_group_id, "Especifique");
        $this->createDropdownField($group5->clinical_record_field_group_id, "Lesión de furca", [
            "Ausentes", "Presentes"
        ]);
        $this->createTextAreaField($group5->clinical_record_field_group_id, "Especifique");
        $this->createDropdownField($group5->clinical_record_field_group_id, "Abfracciones dentales", [
            "Ausentes", "Presentes"
        ]);
        $this->createTextAreaField($group5->clinical_record_field_group_id, "Especifique");

        $group6 = new ClinicalRecordFieldGroup();
        $group6->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group6->title = "Examen oclusal transversal";
        $group6->save();

        $this->createCheckboxesField($group6->clinical_record_field_group_id, "Mordida cruzada", [
            "Ausente", "Presente", "Derecha", "Izquierda"
        ]);
        $this->createDropdownField($group6->clinical_record_field_group_id, "Tipo de mordida cruzada posterior", [
            "Funcional", "Dentoalveolar", "Esquelética"
        ]);
        $this->createCheckboxesField($group6->clinical_record_field_group_id, "Compensación dental", [
            "Derecha", "Izquierda", "Superior", "Inferior", "Ausente"
        ]);
        $this->createTextAreaField($group6->clinical_record_field_group_id, "Especifique");
        $this->createCheckboxesField($group6->clinical_record_field_group_id, "Mordida en tijera", [
            "Ausente", "Presente", "Derecha", "Izquierda"
        ]);
        $this->createDropdownField($group6->clinical_record_field_group_id, "Lmds/ldmi", [
            "Coincidente", "No coincidente"
        ]);
        $this->createInputTextField($group6->clinical_record_field_group_id, "Desviación lmds/lmf derecha (mm)");
        $this->createInputTextField($group6->clinical_record_field_group_id, "Desviación lmds/lmf izquierda (mm)");
        $this->createInputTextField($group6->clinical_record_field_group_id, "Desviación lmdi/lmf derecha (mm)");
        $this->createInputTextField($group6->clinical_record_field_group_id, "Desviación lmdi/lmf izquierda (mm)");

        $group7 = new ClinicalRecordFieldGroup();
        $group7->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group7->title = "Examen oclusal vertical";
        $group7->save();

        $this->createDropdownField($group7->clinical_record_field_group_id, "Overbite", [
            "Mordida profunda", "Normal", "Mordida abierta"
        ]);
        $this->createInputTextField($group7->clinical_record_field_group_id, "Especifique (mm)");
        $this->createDropdownField($group7->clinical_record_field_group_id, "Curva de spee", [
            "Invertida", "Aumentada", "Normal"
        ]);
        $this->createInputTextField($group7->clinical_record_field_group_id, "Especifique (mm)");
        $this->createDropdownField($group7->clinical_record_field_group_id, "Mordida abierta posterior", [
            "Ausentes", "Presentes"
        ]);
        $this->createInputTextField($group7->clinical_record_field_group_id, "Mordida abierta posterior derecha (mm)");
        $this->createInputTextField($group7->clinical_record_field_group_id, "Mordida abierta posterior izquierda (mm)");
        $this->createDropdownField($group7->clinical_record_field_group_id, "Extrusiones dentales", [
            "Ausentes", "Presentes"
        ]);
        $this->createTextAreaField($group7->clinical_record_field_group_id, "Especifique");
        $this->createDropdownField($group7->clinical_record_field_group_id, "Intrusiones dentales", [
            "Ausentes", "Presentes"
        ]);
        $this->createTextAreaField($group7->clinical_record_field_group_id, "Especifique");

        $group8 = new ClinicalRecordFieldGroup();
        $group8->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group8->title = "Examen oclusal sagital";
        $group8->save();

        $this->createCheckboxesField($group8->clinical_record_field_group_id, "Relación molar derecha", [
            "I", "II", "III", "No valorable", "Completa", "Incompleta"
        ]);
        $this->createCheckboxesField($group8->clinical_record_field_group_id, "Relación molar izquierda", [
            "I", "II", "III", "No valorable", "Completa", "Incompleta"
        ]);
        $this->createCheckboxesField($group8->clinical_record_field_group_id, "Relación canina derecha", [
            "I", "II", "III", "No valorable", "Completa", "Incompleta"
        ]);
        $this->createCheckboxesField($group8->clinical_record_field_group_id, "Relación canina izquierda", [
            "I", "II", "III", "No valorable", "Completa", "Incompleta"
        ]);
        $this->createCheckboxesField($group8->clinical_record_field_group_id, "Relación incisiva simétrica", [
            "I", "II", "III", "No valorable", "Completa", "Incompleta"
        ]);
        $this->createTextAreaField($group8->clinical_record_field_group_id, "Especifique");
        $this->createTextAreaField($group8->clinical_record_field_group_id, "Relación incisiva asimétrica (mm)");
        $this->createDropdownField($group8->clinical_record_field_group_id, "Inclinación incisivos centrales superiores", [
            "Normal", "Proinclinación", "Retroinclinación"
        ]);
        $this->createDropdownField($group8->clinical_record_field_group_id, "Inclinación laterales superiores", [
            "Normal", "Proinclinación", "Retroinclinación"
        ]);
        $this->createDropdownField($group8->clinical_record_field_group_id, "Inclinación incisivos centrales inferiores", [
            "Normal", "Proinclinación", "Retroinclinación"
        ]);
        $this->createDropdownField($group8->clinical_record_field_group_id, "Inclinación incisivos laterales inferiores", [
            "Normal", "Proinclinación", "Retroinclinación"
        ]);
        $this->createDropdownField($group8->clinical_record_field_group_id, "Mesioinclinación dental", [
            "Ausente", "Presente"
        ]);
        $this->createTextAreaField($group8->clinical_record_field_group_id, "Especifique");

        $group9 = new ClinicalRecordFieldGroup();
        $group9->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group9->title = "Examen oclusal axial superior";
        $group9->save();
        $this->createDropdownField($group9->clinical_record_field_group_id, "Forma arcada", [
            "Triangular", "Herradura", "Cuadrada", "Parabólica"
        ]);
        $this->createDropdownField($group9->clinical_record_field_group_id, "Simetría arcada", [
            "Presente", "Ausente"
        ]);
        $this->createTextAreaField($group9->clinical_record_field_group_id, "Especifique");
        $this->createCheckboxesField($group9->clinical_record_field_group_id, "Comprensión arcada", [
            "Ausente", "Presente", "Derecha", "Izquierda"
        ]);
        $this->createCheckboxesField($group9->clinical_record_field_group_id, "Dilatación arcada", [
            "Ausente", "Presente", "Derecha", "Izquierda"
        ]);
        $this->createCheckboxesField($group9->clinical_record_field_group_id, "Discrepancia óseo-dentaria", [
            "Positiva", "Negativa", "Leve", "Moderada", "Severa"
        ]);
        $this->createDropdownField($group9->clinical_record_field_group_id, "Rotaciones dentarias", [
            "Presentes", "Ausentes"
        ]);
        $this->createTextAreaField($group9->clinical_record_field_group_id, "Especifique");
        $this->createDropdownField($group9->clinical_record_field_group_id, "Inclinación axial segmento posterior", [
            "Normal", "Vestibular", "Palatino"
        ]);

        $group10 = new ClinicalRecordFieldGroup();
        $group10->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group10->title = "Examen oclusal axial inferior";
        $group10->save();
        $this->createDropdownField($group10->clinical_record_field_group_id, "Forma arcada", [
            "Triangular", "Herradura", "Cuadrada", "Parabólica"
        ]);
        $this->createDropdownField($group10->clinical_record_field_group_id, "Simetría arcada", [
            "Presente", "Ausente"
        ]);
        $this->createTextAreaField($group10->clinical_record_field_group_id, "Especifique");
        $this->createCheckboxesField($group10->clinical_record_field_group_id, "Comprensión arcada", [
            "Ausente", "Presente", "Derecha", "Izquierda"
        ]);
        $this->createCheckboxesField($group10->clinical_record_field_group_id, "Dilatación arcada", [
            "Ausente", "Presente", "Derecha", "Izquierda"
        ]);
        $this->createCheckboxesField($group10->clinical_record_field_group_id, "Discrepancia óseo-dentaria", [
            "Positiva", "Negativa", "Leve", "Moderada", "Severa"
        ]);
        $this->createDropdownField($group10->clinical_record_field_group_id, "Rotaciones dentarias", [
            "Presentes", "Ausentes"
        ]);
        $this->createTextAreaField($group10->clinical_record_field_group_id, "Especifique");
        $this->createDropdownField($group10->clinical_record_field_group_id, "Inclinación axial segmento posterior", [
            "Normal", "Vestibular", "Lingual"
        ]);

        $group11 = new ClinicalRecordFieldGroup();
        $group11->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group11->title = "Apertura";
        $group11->save();
        $this->createCheckboxesField($group11->clinical_record_field_group_id, "Chasquido", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);
        $this->createCheckboxesField($group11->clinical_record_field_group_id, "Crepitación", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);
        $this->createCheckboxesField($group11->clinical_record_field_group_id, "Desviación", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);
        $this->createCheckboxesField($group11->clinical_record_field_group_id, "Dolor", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);
        $this->createInputTextField($group10->clinical_record_field_group_id, "Máxima apertura (mm)");

        $group12 = new ClinicalRecordFieldGroup();
        $group12->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group12->title = "Lateralidad derecha";
        $group12->save();
        $this->createDropdownField($group12->clinical_record_field_group_id, "Guía canina", [
            "Normal", "Interferencia"
        ]);
        $this->createTextAreaField($group12->clinical_record_field_group_id, "Especifique");
        $this->createCheckboxesField($group12->clinical_record_field_group_id, "Chasquido", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);
        $this->createCheckboxesField($group12->clinical_record_field_group_id, "Crepitación", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);
        $this->createCheckboxesField($group12->clinical_record_field_group_id, "Dolor", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);
        
        $group13 = new ClinicalRecordFieldGroup();
        $group13->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group13->title = "Lateralidad izquierda";
        $group13->save();
        $this->createDropdownField($group13->clinical_record_field_group_id, "Guía canina", [
            "Normal", "Interferencia"
        ]);
        $this->createTextAreaField($group13->clinical_record_field_group_id, "Especifique");
        $this->createCheckboxesField($group13->clinical_record_field_group_id, "Chasquido", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);
        $this->createCheckboxesField($group13->clinical_record_field_group_id, "Crepitación", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);
        $this->createCheckboxesField($group13->clinical_record_field_group_id, "Dolor", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);

        $group14 = new ClinicalRecordFieldGroup();
        $group14->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group14->title = "Protrusiva";
        $group14->save();
        $this->createDropdownField($group14->clinical_record_field_group_id, "Guía canina", [
            "Normal", "Interferencia"
        ]);
        $this->createTextAreaField($group14->clinical_record_field_group_id, "Especifique");
        $this->createCheckboxesField($group14->clinical_record_field_group_id, "Chasquido", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);
        $this->createCheckboxesField($group14->clinical_record_field_group_id, "Crepitación", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);
        $this->createCheckboxesField($group14->clinical_record_field_group_id, "Dolor", [
            "Ausente", "Presente", "ATM derecha", "ATM izquierda"
        ]);

        $group15 = new ClinicalRecordFieldGroup();
        $group15->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group15->title = "Relación céntrica";
        $group15->save();
        $this->createDropdownField($group15->clinical_record_field_group_id, "Manipulación mandibular", [
            "Fácil", "Término medio", "Difícil", "Muy difícil"
        ]);
        $this->createDropdownField($group15->clinical_record_field_group_id, "Discrepancia-céntrica y habitual", [
            "Ausente", "Presente"
        ]);
        $this->createTextAreaField($group15->clinical_record_field_group_id, "Interferencia céntrica");

        $group16 = new ClinicalRecordFieldGroup();
        $group16->clinical_record_id = $orthodonticsClinicalExploration->clinical_record_id;
        $group16->title = "Análisis funcional";
        $group16->save();
        $this->createDropdownField($group16->clinical_record_field_group_id, "Evaluación hipertrofia amigdalar", [
            "0", "1", "2", "3", "4", "5"
        ]);
        $this->createDropdownField($group16->clinical_record_field_group_id, "Evaluación movilidad lingual", [
            "0", "1", "2", "3", "4", "5"
        ]);
        $this->createDropdownField($group16->clinical_record_field_group_id, "Evaluación contracción narinas", [
            "0", "1", "2", "3", "4", "5"
        ]);
        $this->createDropdownField($group16->clinical_record_field_group_id, "Evaluación de la respiración", [
            "Nasal", "Bucal", "Mixta"
        ]);
        $this->createDropdownField($group16->clinical_record_field_group_id, "Evaluación de la deglución", [
            "Típica", "Atípica"
        ]);
        $this->createDropdownField($group16->clinical_record_field_group_id, "Hábito de succión no nutritiva", [
            "Ausente", "Presente"
        ]);
        $this->createTextAreaField($group16->clinical_record_field_group_id, "Especifique");
        $this->createDropdownField($group16->clinical_record_field_group_id, "Hábito de interposición lingual", [
            "Ausente", "Presente"
        ]);
        $this->createTextAreaField($group16->clinical_record_field_group_id, "Especifique");
        $this->createDropdownField($group16->clinical_record_field_group_id, "Hábito de succión labio inferior", [
            "Ausente", "Presente"
        ]);
        $this->createTextAreaField($group16->clinical_record_field_group_id, "Especifique");
        $this->createDropdownField($group16->clinical_record_field_group_id, "Hábito de mordisqueo", [
            "Ausente", "Presente"
        ]);
        $this->createTextAreaField($group16->clinical_record_field_group_id, "Especifique");
        $this->createDropdownField($group16->clinical_record_field_group_id, "Hábito de bruxismo", [
            "Ausente", "Presente"
        ]);
        $this->createTextAreaField($group16->clinical_record_field_group_id, "Especifique");
    }

    private function orthodonticsDxAndTx() {
        $orthodonticsDxAndTx = new ClinicalRecord();
        $orthodonticsDxAndTx->name = "Ortodoncia Dx. y Tx.";
        $orthodonticsDxAndTx->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $orthodonticsDxAndTx->clinical_record_id;
        $group1->title = "Diagnóstico y plan de tratamiento";
        $group1->save();
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Resumen diagnóstico");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Etiología");
        $this->createDropdownField($group1->clinical_record_field_group_id, "Conducta terapéutica", [
            "Ortodoncia y cirugía", "Segunda fase", "Primera fase", "En observación"
        ]);
        $this->createDropdownField($group1->clinical_record_field_group_id, "Pronóstico", [
            "Favorable", "Desfavorable", "Reservado"
        ]);
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Objetivos de tx.");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Plan de tratamiento mandibular");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Extracciones inmediatas");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Extracciones futuras");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Brackets");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Medida");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Tipo de anclaje");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Observaciones");
    }

    private function comprehensiveDiagnosis() {
        $comprehensiveDiagnosis = new ClinicalRecord();
        $comprehensiveDiagnosis->name = "Diagnóstico integral";
        $comprehensiveDiagnosis->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $comprehensiveDiagnosis->clinical_record_id;
        $group1->title = "Diagnóstico integral";
        $group1->save();
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Hallazgos");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Presión arterial");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Pulso");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Diagnósticos sistémicos");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Diagnósticos locales");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Medicina bucal");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Indicaciones especiales");
    }

    private function riskPeriodontalDisease() {
        $riskPeriodontalDisease = new ClinicalRecord();
        $riskPeriodontalDisease->name = "Riesgo de enfermedad periodontal";
        $riskPeriodontalDisease->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $riskPeriodontalDisease->clinical_record_id;
        $group1->title = "Identificación de riesgo de enfermedad periodontal";
        $group1->save();
        $this->createBooleanField($group1->clinical_record_field_group_id, "¿Le sangran las encías?");
        $this->createBooleanField($group1->clinical_record_field_group_id, "¿Se le han retraído las encías, o parece que sus dientes son más largos?");
        $this->createBooleanField($group1->clinical_record_field_group_id, "¿Fuma o usa algún producto derivado del tabaco?");
        $this->createBooleanField($group1->clinical_record_field_group_id, "¿Ha visitado a su dentista en los 2 últimos años?");
        $this->createDropdownField($group1->clinical_record_field_group_id, "¿Con qué frecuencia se limpia entre sus dientes con hilo dental?", [
            "Siempre", "A veces", "Nunca"
        ]);
        $this->createBooleanField($group1->clinical_record_field_group_id, "¿Tiene alguno de los siguientes problemas de salud?: Del corazón, osteoporosis, altos niveles de estrés, diabetes");
        $this->createBooleanField($group1->clinical_record_field_group_id, "¿Le han dicho alguna vez que tiene problemas de encías, infección o inflamación de las encías?");
        $this->createDropdownField($group1->clinical_record_field_group_id, "¿Algún miembro de su familia ha tenido problemas de encías?", [
            "Sí", "No", "No lo sé"
        ]);
        $this->createBooleanField($group1->clinical_record_field_group_id, "¿Está usted embarazada?");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Riesgo periodontal");
    }

    private function radiographicFindings() {
        $radiographicFindings = new ClinicalRecord();
        $radiographicFindings->name = "Hallazgos radiográficos";
        $radiographicFindings->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $radiographicFindings->clinical_record_id;
        $group1->title = "Dientes";
        $group1->save();
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Ausentes");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Malposición");
        $this->createCheckboxesField($group1->clinical_record_field_group_id, "Inclusiones", [
            "28", "18", "23", "13", "38", "48"
        ]);
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Otros");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Semierupcionados o en infraoclusión");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Raíces residuales");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Resorción patológica");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Anomalías de forma, tamaño o número");

        $group2 = new ClinicalRecordFieldGroup();
        $group2->clinical_record_id = $radiographicFindings->clinical_record_id;
        $group2->title = "Caries";
        $group2->save();
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Interproximal");
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Caries recurrentes");
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Otras caries");
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Restauraciones defectuosas y sobreobturaciones interproximales");
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Comunicaciones camerales");

        $group3 = new ClinicalRecordFieldGroup();
        $group3->clinical_record_id = $radiographicFindings->clinical_record_id;
        $group3->title = "Hueso y ligamento periodontal";
        $group3->save();
        $this->createTextAreaField($group3->clinical_record_field_group_id, "Pérdida horizontal (indicar sextante)");
        $this->createTextAreaField($group3->clinical_record_field_group_id, "Pérdida de hueso vertical (indicar número de diente, m: mesial, d: distal)");
        $this->createTextAreaField($group3->clinical_record_field_group_id, "Cráteres osos o inversión de arquitectura ósea (indicar número de diente)");
        $this->createTextAreaField($group3->clinical_record_field_group_id, "Aumento del espacio del ligamento paradontal (indicar número de diente)");
        $this->createTextAreaField($group3->clinical_record_field_group_id, "Disminución del espacio del ligamento paradontal (indicar número de diente)");
        $this->createTextAreaField($group3->clinical_record_field_group_id, "Alteraciones en el espesor y/o continuidad de la lámina dura (indicar número de diente)");

        $group4 = new ClinicalRecordFieldGroup();
        $group4->clinical_record_id = $radiographicFindings->clinical_record_id;
        $group4->title = "Cálculos";
        $group4->save();
        $this->createBooleanField($group4->clinical_record_field_group_id, "No visibles");
        $this->createBooleanField($group4->clinical_record_field_group_id, "Generalizado");
        $this->createTextAreaField($group4->clinical_record_field_group_id, "Localizados (indicar sextante)");

        $group5 = new ClinicalRecordFieldGroup();
        $group5->clinical_record_id = $radiographicFindings->clinical_record_id;
        $group5->title = "Patología ósea de los maxilares";
        $group5->save();
        $this->createTextAreaField($group5->clinical_record_field_group_id, "Descripción de la lesión (sitio, asociado a dientes (¿qué dientes?), aspecto rx (n, ro, mx))");
        $this->createTextAreaField($group5->clinical_record_field_group_id, "Forma (unilocular, multilocular, amorfa, otras)");
        $this->createTextAreaField($group5->clinical_record_field_group_id, "Bordes (definidos, indefinidos)");

        $group6 = new ClinicalRecordFieldGroup();
        $group6->clinical_record_id = $radiographicFindings->clinical_record_id;
        $group6->title = "Resumen de hallaazgos radiográficos";
        $group6->save();
        $this->createTextAreaField($group6->clinical_record_field_group_id, "Resumen de hallazgos radiográficos");
        $this->createTextAreaField($group6->clinical_record_field_group_id, "Observaciones e indicaciones");
    }

    private function phase1Systemic() {
        $phase1Systemic = new ClinicalRecord();
        $phase1Systemic->name = "Fase I: Sistémica";
        $phase1Systemic->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $phase1Systemic->clinical_record_id;
        $group1->title = "Sistémica";
        $group1->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field1->title = "Medidas de precaución y control";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();
    }

    private function phase2nonDentalPremises() {
        $phase2nonDentalPremises = new ClinicalRecord();
        $phase2nonDentalPremises->name = "Fase II: Local no dental";
        $phase2nonDentalPremises->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $phase2nonDentalPremises->clinical_record_id;
        $group1->title = "Local no dental";
        $group1->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field1->title = "Tumores, estomatitis, lesiones sospechosas";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();
    }

    private function phase3Conditioning() {
        $phase3Conditioning = new ClinicalRecord();
        $phase3Conditioning->name = "Fase III: Acondicionamiento";
        $phase3Conditioning->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $phase3Conditioning->clinical_record_id;
        $group1->title = "Fase III";
        $group1->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field1->title = "Descripción";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();
    }

    private function phase4rehabilitation() {
        $phase4rehabilitation = new ClinicalRecord();
        $phase4rehabilitation->name = "Fase IV: Rehabilitación";
        $phase4rehabilitation->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $phase4rehabilitation->clinical_record_id;
        $group1->title = "Fase IV";
        $group1->save();

        $field1 = new ClinicalRecordField();
        $field1->clinical_record_field_group_id = $group1->clinical_record_field_group_id;
        $field1->title = "Descripción";
        $field1->type = 1;
        $field1->has_multiple_options = false;
        $field1->save();
    }

    private function phase5tracing() {
        $phase5tracing = new ClinicalRecord();
        $phase5tracing->name = "Fase V: Seguimiento";
        $phase5tracing->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $phase5tracing->clinical_record_id;
        $group1->title = "Seguimiento";
        $group1->save();
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Descripción");
    }

    private function physicalExam() {
        $physicalExam = new ClinicalRecord();
        $physicalExam->name = "Examen físico";
        $physicalExam->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $physicalExam->clinical_record_id;
        $group1->title = "Examen extraoral";
        $group1->save();
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Observación general (color, cicatrices, lesiones, textura de la piel, simetría, facies)");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Ganglios y otras masas (palpables, sintomáticos, zona, tamaño, movilidad)");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "ATM (ruidos, dolor, desviación de la mandíbula, trabazón, otros)");
        $this->createTextAreaField($group1->clinical_record_field_group_id, "Músculos (sintomatología, localización del dolor)");

        $group2 = new ClinicalRecordFieldGroup();
        $group2->clinical_record_id = $physicalExam->clinical_record_id;
        $group2->title = "Examen intraoral";
        $group2->save();
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Vestíbulo (color, profundidad, exostosis, endostosis, abultamientos, pigmentaciones, otros)");
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Paladar duro y blanco (forma, color, movilidad, deformaciones, otros)");
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Istmo de las fauces y orofaringe");
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Lengua (forma, movilidad, saburra, textura del dorso, bordes, vientre, frenillo lingual, color, otros)");
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Piso de boca (color, textura, glándulas sublinguales, glándulas submandibulares, otros)");
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Examen funcional de glándulas salivales");
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Oclusión");
        $this->createTextAreaField($group2->clinical_record_field_group_id, "Evaluación gingival");
    }

    private function formCariesRisk() {
        $formCariesRisk = new ClinicalRecord();
        $formCariesRisk->name = "Forma de riesgo de caries";
        $formCariesRisk->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $formCariesRisk->clinical_record_id;
        $group1->title = "Indicadores de enfermedad";
        $group1->save();
        $this->createBooleanField($group1->clinical_record_field_group_id, "Cavidad visibles o penetración radiográfica a la dentina");
        $this->createBooleanField($group1->clinical_record_field_group_id, "Lesión radiográfica interproximal en esmalte");
        $this->createBooleanField($group1->clinical_record_field_group_id, "Manchas blancas en superficies lisas");
        $this->createBooleanField($group1->clinical_record_field_group_id, "Restauraciones en los últimos 3 años");

        $group2 = new ClinicalRecordFieldGroup();
        $group2->clinical_record_id = $formCariesRisk->clinical_record_id;
        $group2->title = "Factores de riesgo";
        $group2->save();
        $this->createBooleanField($group2->clinical_record_field_group_id, "Sm o lb medios o altos a través de cultivos");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Placa visible en los dientes");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Frecuentes alimentos entre comidas");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Fosas y fisuras profundas");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Uso de alcohol, tabaco o drogas");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Inadecuado flujo salivaa, por medida u observación");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Factores causantes de hiposalivación (medicamentos, radiación, enfermedad)");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Raices expuestas");
        $this->createBooleanField($group2->clinical_record_field_group_id, "Aparatos ortodónticos");

        $group3 = new ClinicalRecordFieldGroup();
        $group3->clinical_record_id = $formCariesRisk->clinical_record_id;
        $group3->title = "Factores de protección";
        $group3->save();
        $this->createBooleanField($group3->clinical_record_field_group_id, "Vivir, trabajar o estudiar en una comunidad con agua fluorada");
        $this->createBooleanField($group3->clinical_record_field_group_id, "Cepillado con pasta fluorada al menos una vez al día");
        $this->createBooleanField($group3->clinical_record_field_group_id, "Enjuague diario con fluoruro (naf 0.05%)");
        $this->createBooleanField($group3->clinical_record_field_group_id, "Barniz de fluoruro en los últimos 6 meses");
        $this->createBooleanField($group3->clinical_record_field_group_id, "Clorhexidina usada por una semana, en cada mes de los últimos 6 meses");
        $this->createBooleanField($group3->clinical_record_field_group_id, "Pastillas o chicles con xylitol diariamente por los últimos 6 meses");
        $this->createBooleanField($group3->clinical_record_field_group_id, "Pasta con calcio y fosfato en los últimos 6 meses");
        $this->createBooleanField($group3->clinical_record_field_group_id, "Adecuado flujo salival");
    }

    private function cancerRiskFormatAndScore() {
        $cancerRiskFormatAndScore = new ClinicalRecord();
        $cancerRiskFormatAndScore->name = "Formato y puntaje de riesgo de cáncer";
        $cancerRiskFormatAndScore->save();

        $group1 = new ClinicalRecordFieldGroup();
        $group1->clinical_record_id = $cancerRiskFormatAndScore->clinical_record_id;
        $group1->title = "Tabla de puntos";
        $group1->save();
        $this->createInputTextField($group1->clinical_record_field_group_id, "Edad - < 40 = 1, 40-65 = 2, > 65 = 3");
        $this->createInputTextField($group1->clinical_record_field_group_id, "Sexo - Masculino = 1, Femenino = 2, Otro = 3");
        $this->createInputTextField($group1->clinical_record_field_group_id, "Tabaquismo - No = 1, Sí: < 1 cajetilla = 10, 1-2 cajetillas = 11, > 2 cajetillas = 12");
        $this->createInputTextField($group1->clinical_record_field_group_id, "Consumo de alcohol - No = 0, < 15 bebidas a la semana = 4, > 15 bebidas a la semana = 5");
        $this->createInputTextField($group1->clinical_record_field_group_id, "Exposición al sol - No = 0, Sí = 2");
        $this->createInputTextField($group1->clinical_record_field_group_id, "Consumo de frutas y verduras - No = 1, Sí = 0");
        $this->createInputTextField($group1->clinical_record_field_group_id, "Historia de exposición a VPH - No = 0, Sí = 2");
        $this->createInputTextField($group1->clinical_record_field_group_id, "Color de piel - No = 0, Sí = 1");
        $this->createInputTextField($group1->clinical_record_field_group_id, "Visitas al dentista - No = 1, Sí = 0");
        $this->createInputTextField($group1->clinical_record_field_group_id, "Historia de cáncer en cabeza o cuello - No = 0, Sí = 3");

        $group2 = new ClinicalRecordFieldGroup();
        $group2->clinical_record_id = $cancerRiskFormatAndScore->clinical_record_id;
        $group2->title = "Cuestionario de riesgo para cáncer de cabeza y cuello";
        $group2->save();
        $this->createInputTextField($group2->clinical_record_field_group_id, "Edad - < 40 = 1, 40-65 = 2, > 65 = 3");
    }

    private function createInputTextField($clinical_record_field_group_id, $title, $subtitle = null) {
        $field = new ClinicalRecordField();
        $field->clinical_record_field_group_id = $clinical_record_field_group_id;
        $field->title = $title;
        $field->subtitle = $subtitle;
        $field->type = 0;
        $field->has_multiple_options = false;
        $field->save();
    }

    private function createTextAreaField($clinical_record_field_group_id, $title, $subtitle = null) {
        $field = new ClinicalRecordField();
        $field->clinical_record_field_group_id = $clinical_record_field_group_id;
        $field->title = $title;
        $field->subtitle = $subtitle;
        $field->type = 1;
        $field->has_multiple_options = false;
        $field->save();
    }

    private function createBooleanOptions($clinical_record_field_id, $clinical_record_field_group_id, $includeTextAreaField = false, $fieldName = "Observaciones") {
        $option1 = new ClinicalRecordFieldOption();
        $option1->clinical_record_field_id = $clinical_record_field_id;
        $option1->option = "Sí";
        $option1->save();
        $option2 = new ClinicalRecordFieldOption();
        $option2->clinical_record_field_id = $clinical_record_field_id;
        $option2->option = "No";
        $option2->save();
        if ($includeTextAreaField) {
            $field1 = new ClinicalRecordField();
            $field1->clinical_record_field_group_id = $clinical_record_field_group_id;
            $field1->title = $fieldName;
            $field1->type = 1;
            $field1->has_multiple_options = false;
            $field1->save();
        }
    }

    private function createBooleanField($clinical_record_field_group_id, $title, $includeTextAreaField = false, $fieldName = "Observaciones") {
        $field = new ClinicalRecordField();
        $field->clinical_record_field_group_id = $clinical_record_field_group_id;
        $field->title = $title;
        $field->type = 3;
        $field->has_multiple_options = true;
        $field->save();
        $this->createBooleanOptions($field->clinical_record_field_id, $clinical_record_field_group_id, $includeTextAreaField, $fieldName);
    }

    private function createCheckboxesField($clinical_record_field_group_id, $title, $options, $subtitle = null) {
        $field = new ClinicalRecordField();
        $field->clinical_record_field_group_id = $clinical_record_field_group_id;
        $field->title = $title;
        $field->subtitle = $subtitle;
        $field->type = 4;
        $field->has_multiple_options = true;
        $field->save();
        foreach ($options as $option) {
            $fieldOption = new ClinicalRecordFieldOption();
            $fieldOption->clinical_record_field_id = $field->clinical_record_field_id;
            $fieldOption->option = $option;
            $fieldOption->save();
        }
    }

    private function createDropdownField($clinical_record_field_group_id, $title, $options) {
        $field = new ClinicalRecordField();
        $field->clinical_record_field_group_id = $clinical_record_field_group_id;
        $field->title = $title;
        $field->type = 2;
        $field->has_multiple_options = true;
        $field->save();
        foreach ($options as $option) {
            $fieldOption = new ClinicalRecordFieldOption();
            $fieldOption->clinical_record_field_id = $field->clinical_record_field_id;
            $fieldOption->option = $option;
            $fieldOption->save();
        }
    }
}
