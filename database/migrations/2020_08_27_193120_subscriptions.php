<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subscriptions extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create("subscription", function (Blueprint $table) {
            $table->increments("subscription_id");
            $table->integer("account_id")->unsigned();
            $table->foreign("account_id")->references("account_id")->on("account");
            $table->date("purchase_date");
            $table->integer("payment_method")->unsigned();
            $table->string("payment_reference")->nullable();
            $table->integer("type")->unsigned();
            $table->float("cost")->unsigned();
            $table->date("end_date");
            $table->string("transaction_id")->nullable();
            $table->dateTime("payment_date")->nullable();
            $table->integer("status")->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop("subscription");
    }
}
