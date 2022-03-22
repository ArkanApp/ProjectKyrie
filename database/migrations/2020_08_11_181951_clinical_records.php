<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClinicalRecords extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create("clinical_record", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("clinical_record_id");
            $table->integer("clinic_id")->unsigned()->nullable();
            $table->foreign("clinic_id")->references("clinic_id")->on("clinic");
            $table->string("name", 100);
        });
        Schema::create("clinical_record_patient", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->integer("clinical_record_id")->unsigned();
            $table->foreign("clinical_record_id")->references("clinical_record_id")->on("clinical_record");
            $table->integer("patient_id")->unsigned();
            $table->foreign("patient_id")->references("patient_id")->on("patient");
            $table->date("register_date");
            $table->primary(["clinical_record_id", "patient_id"]);
        });
        Schema::create("clinical_record_field_group", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("clinical_record_field_group_id");
            $table->integer("clinical_record_id")->unsigned();
            $table->foreign("clinical_record_id")->references("clinical_record_id")->on("clinical_record");
            $table->string("title", 100);
        });
        Schema::create("clinical_record_field", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("clinical_record_field_id");
            $table->integer("clinical_record_field_group_id")->unsigned();
            $table->foreign("clinical_record_field_group_id", "clinical_record_field_fg_foreign")
                ->references("clinical_record_field_group_id")->on("clinical_record_field_group");
            $table->string("title");
            $table->string("subtitle")->nullable();
            $table->integer("type");
            $table->boolean("has_multiple_options");
        });
        Schema::create("clinical_record_field_value", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("clinical_record_field_value_id");
            $table->integer("clinical_record_field_id")->unsigned();
            $table->foreign("clinical_record_field_id")->references("clinical_record_field_id")->on("clinical_record_field");
            $table->integer("patient_id")->unsigned();
            $table->foreign("patient_id")->references("patient_id")->on("patient");
            $table->string("value", 500);
        });
        Schema::create("clinical_record_field_option", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("clinical_record_field_option_id");
            $table->integer("clinical_record_field_id")->unsigned();
            $table->foreign("clinical_record_field_id")->references("clinical_record_field_id")->on("clinical_record_field");
            $table->string("option");
        });
        Schema::create("clinical_record_field_option_patient", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->integer("clinical_record_field_option_id")->unsigned();
            $table->foreign("clinical_record_field_option_id", "clinical_record_field_option_id_foreign")->references("clinical_record_field_option_id")->on("clinical_record_field_option");
            $table->integer("patient_id")->unsigned();
            $table->foreign("patient_id")->references("patient_id")->on("patient");
            $table->primary(["clinical_record_field_option_id", "patient_id"], "clinical_record_field_option_patient_primary");
        });

        Artisan::call("db:seed", [
            "--class" => "DatabaseSeeder",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop("clinical_record_field_option_patient");
        Schema::drop("clinical_record_field_option");
        Schema::drop("clinical_record_field_value");
        Schema::drop("clinical_record_field_group");
        Schema::drop("clinical_record_field");
        Schema::drop("clinical_record_patient");
        Schema::drop("clinical_record");
    }
}
