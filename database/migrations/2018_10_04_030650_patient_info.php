<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PatientInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('doc_id')->nullable();
            $table->foreign('doc_id')->references('id')->on('doctor_infos')->onDelete('cascade');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('spouse_g');
            $table->string('birthdate');
            $table->string('gender');
            $table->string('contact_number');
            $table->string('address');
            $table->string('image_ext')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE patient_infos ADD image LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_infos');
    }
}
