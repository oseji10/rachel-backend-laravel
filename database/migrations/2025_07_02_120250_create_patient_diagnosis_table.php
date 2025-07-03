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
        Schema::create('patient_diagnosis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diagnosisId')->nullable();
            $table->unsignedBigInteger('patientId')->nullable();
            $table->string('eye')->nullable();
            
            $table->timestamps();

            $table->foreign('diagnosisId')->references('diagnosisId')->on('diagnosis')->onDelete('cascade');
            $table->foreign('patientId')->references('patientId')->on('patients')->onDelete('cascade');

        });


        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment');
    }
};
