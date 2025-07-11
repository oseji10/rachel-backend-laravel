<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diagnosis', function (Blueprint $table) {
            $table->id('diagnosisId');
            $table->unsignedBigInteger('patientId')->nullable();
            $table->unsignedBigInteger('encounterId')->nullable();
            $table->unsignedBigInteger('diagnosisRight')->nullable();
            $table->unsignedBigInteger('diagnosisLeft')->nullable();
            $table->string('problemsRight')->nullable();
            $table->string('problemsLeft')->nullable();
            $table->timestamps();

            $table->foreign('patientId')->references('patientId')->on('patients')->onDelete('cascade');
            $table->foreign('encounterId')->references('encounterId')->on('encounters')->onDelete('cascade');

            $table->foreign('diagnosisRight')->references('id')->on('diagnosis_list')->onDelete('cascade');
            $table->foreign('diagnosisLeft')->references('id')->on('diagnosis_list')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosis');
    }
};
