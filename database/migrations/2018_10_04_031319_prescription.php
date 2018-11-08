<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Prescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('prescription', function (Blueprint $table) {
            $table->increments('id');
             $table->unsignedInteger('pid')->nullable();
            $table->foreign('pid')->references('id')->on('patient_infos')->onDelete('cascade');
            $table->string('generic_name');
            $table->string('brand_name');
            $table->string('dosage_form');
            $table->string('dosage_strength');
            $table->integer('pres_quantity');
            $table->integer('quantity')->nullable();
            $table->string('signa');
            $table->string('allergy')->nullable();
            $table->string('time');
            $table->string('per_day');
            $table->string('refill_check');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescription');
    }
}
