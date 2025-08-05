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
        Schema::create('encounters', function (Blueprint $table) {
            $table->id('encounterId');
            $table->unsignedBigInteger('patientId')->nullable();
            $table->unsignedBigInteger('consultingId')->nullable();
            $table->unsignedBigInteger('continueConsultingId')->nullable();
            $table->unsignedBigInteger('sketchId')->nullable();
            $table->unsignedBigInteger('diagnosisId')->nullable();
            $table->unsignedBigInteger('investigationId')->nullable();
            $table->unsignedBigInteger('refractionId')->nullable();
            $table->unsignedBigInteger('appointmentId')->nullable();
            $table->unsignedBigInteger('treatmentId')->nullable();
            
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('patientId')->references('patientId')->on('patients')->onDelete('cascade');
            $table->foreign('consultingId')->references('consultingId')->on('consulting')->onDelete('cascade');
            $table->foreign('continueConsultingId')->references('continueConsultingId')->on('continue_consulting')->onDelete('cascade');
            $table->foreign('sketchId')->references('sketchId')->on('sketch')->onDelete('cascade');
            $table->foreign('diagnosisId')->references('diagnosisId')->on('diagmosis')->onDelete('cascade');
            $table->foreign('investigationId')->references('invesigationId')->on('investigations')->onDelete('cascade');
            $table->foreign('refractionId')->references('refractionId')->on('refractions')->onDelete('cascade');
            $table->foreign('appointmentId')->references('appointmentId')->on('appointments')->onDelete('cascade');
            $table->foreign('treatmentId')->references('treatmentId')->on('treatments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encounters');
    }
};
