<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            $table->string('Email')->unique();
            $table->string('Password');

            //Fatherinformation
            $table->string('NameFather');
            $table->string('NationalIDFather');
            $table->string('PassportIDFather');
            $table->string('PhoneFather');
            $table->string('JobFather');
            $table->bigInteger('NationalityFather_id')->unsigned();
            $table->bigInteger('BloodTypeFather_id')->unsigned();
            $table->bigInteger('ReligionFather_id')->unsigned();
            $table->string('AddressFather');

            //Mother information
            $table->string('NameMother');
            $table->string('NationalIDMother');
            $table->string('PassportIDMother');
            $table->string('PhoneMother');
            $table->string('JobMother');
            $table->bigInteger('NationalityMother_id')->unsigned();
            $table->bigInteger('BloodTypeMother_id')->unsigned();
            $table->bigInteger('ReligionMother_id')->unsigned();
            $table->string('AddressMother');
            $table->timestamps();
            //Father foreign
            $table->foreign('NationalityFather_id')->references('id')->on('nationalities');
            $table->foreign('BloodTypeFather_id')->references('id')->on('type_blods');
            $table->foreign('ReligionFather_id')->references('id')->on('religions');
            //Mother foreign
            $table->foreign('NationalityMother_id')->references('id')->on('nationalities');
            $table->foreign('BloodTypeMother_id')->references('id')->on('type_blods');
            $table->foreign('ReligionMother_id')->references('id')->on('religions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_parents');
    }
}
