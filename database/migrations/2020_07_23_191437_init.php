<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Init extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create("area", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("area_id");
            $table->string("name")->unique();
        });
        Schema::create("account", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("account_id");
            $table->integer("area_id")->unsigned();
            $table->foreign("area_id")->references("area_id")->on("area");
            $table->string("email")->unique();
            $table->string("password", 100);
            $table->date("register_date");
            $table->string("name", 100);
            $table->string("last_name", 100);
            $table->string("picture_file")->nullable();
            $table->boolean("verified")->default(false);
            $table->string("verification_token", 128);
            $table->boolean("is_student");
        });
        Schema::create("clinic", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("clinic_id");
            $table->integer("account_id")->unsigned();
            $table->foreign("account_id")->references("account_id")->on("account");
            $table->string("name");
            $table->string("street1");
            $table->integer("external_number");
            $table->integer("internal_number")->nullable();
            $table->string("colony");
            $table->string("municipality");
            $table->string("state");
            $table->integer("country");
            $table->string("zipcode", 10);
            $table->string("picture_file")->nullable();
            $table->string("phone", 20);
        });
        Schema::create("patient", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("patient_id");
            $table->integer("account_id")->unsigned();
            $table->foreign("account_id")->references("account_id")->on("account");
            $table->string("name", 100);
            $table->string("last_name", 100);
            $table->date("birthdate");
            $table->integer("gender");
            $table->string("occupation");
            $table->string("scholarship", 100);
            $table->integer("civil_status");
            $table->integer("nationality");
            $table->string("street1");
            $table->integer("external_number");
            $table->integer("internal_number")->nullable();
            $table->string("colony");
            $table->string("municipality");
            $table->string("state");
            $table->string("zipcode", 10);
            $table->string("home_phone", 20);
            $table->string("cell_phone", 20);
            $table->string("email")->unique();
            $table->date("register_date");
            $table->string("picture_file")->nullable();
            $table->date("last_update");
        });
        Schema::create("image", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("image_id");
            $table->integer("patient_id")->unsigned();
            $table->foreign("patient_id")->references("patient_id")->on("patient");
            $table->string("title");
            $table->string("file_name");
            $table->date("upload_date");
        });
        Schema::create("evolution_note", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("evolution_note_id");
            $table->integer("next_consultation_id")->unsigned()->nullable();
            $table->string("note");
        });
        Schema::create("prescription", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("prescription_id");
            $table->text("content");
        });
        Schema::create("consultation", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("consultation_id");
            $table->integer("patient_id")->unsigned();
            $table->foreign("patient_id")->references("patient_id")->on("patient");
            $table->integer("evolution_note_id")->unsigned()->nullable();
            $table->foreign("evolution_note_id")->references("evolution_note_id")->on("evolution_note");
            $table->integer("prescription_id")->unsigned()->nullable();
            $table->foreign("prescription_id")->references("prescription_id")->on("prescription");
            $table->dateTime("consultation_date");
            $table->text("treatment");
            $table->text("observations")->nullable();
            $table->integer("duration")->nullable();
            $table->float("cost")->unsigned()->nullable();
            $table->integer("status");
        });
        Schema::table("evolution_note", function (Blueprint $table) {
            $table->foreign("next_consultation_id")->references("consultation_id")->on("consultation");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop("consultation");
        Schema::drop("prescription");
        Schema::drop("evolution_note");
        Schema::drop("image");
        Schema::drop("patient");
        Schema::drop("clinic");
        Schema::drop("account");
        Schema::drop("area");
    }
}
