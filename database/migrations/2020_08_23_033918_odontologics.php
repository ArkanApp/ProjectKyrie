<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Odontologics extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create("tooth_face_odontogram", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("tooth_face_odontogram_id");
            $table->integer("patient_id")->unsigned();
            $table->foreign("patient_id")->references("patient_id")->on("patient");
            $table->integer("tooth_number")->unsigned();
            $table->unique(["patient_id", "tooth_number"]);
        });
        Schema::create("tooth_face_disease", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("tooth_face_disease_id");
            $table->integer("tooth_face_odontogram_id")->unsigned();
            $table->foreign("tooth_face_odontogram_id")->references("tooth_face_odontogram_id")->on("tooth_face_odontogram");
            $table->date("register_date");
            $table->boolean("face_vestibular")->nullable();
            $table->boolean("face_lingual")->nullable();
            $table->boolean("face_distal")->nullable();
            $table->boolean("face_mesial")->nullable();
            $table->boolean("face_occlusal")->nullable();
            $table->boolean("face_cervical")->nullable();
            $table->boolean("face_palatine")->nullable();
            $table->integer("disease")->unsigned();
        });
        Schema::create("tooth_odontogram", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("tooth_odontogram_id");
            $table->integer("patient_id")->unsigned();
            $table->foreign("patient_id")->references("patient_id")->on("patient");
            $table->integer("tooth_number")->unsigned();
            $table->unique(["patient_id", "tooth_number"]);
        });
        Schema::create("tooth_disease", function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
            $table->increments("tooth_disease_id");
            $table->integer("tooth_odontogram_id")->unsigned();
            $table->foreign("tooth_odontogram_id")->references("tooth_odontogram_id")->on("tooth_odontogram");
            $table->date("register_date");
            $table->integer("disease")->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop("tooth_disease");
        Schema::drop("tooth_odontogram");
        Schema::drop("tooth_face_disease");
        Schema::drop("tooth_face_odontogram");
    }
}
