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
        Schema::create('appointments', function (Blueprint $table) {
            $table->ID('appointmentId');
            $table->unsignedBigInteger('patientId')->nullable();
            $table->string('encounterId')->nullable();
            $table->string('appointmentDate')->nullable();
            $table->string('appointmentTime')->nullable();
            $table->unsignedBigInteger('doctor')->nullable();
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->enum('status', ['scheduled', 'arrived', 'completed', 'cancelled'])->default('scheduled');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patientId')->references('patientId')->on('patients')->onDelete('cascade');
            // $table->foreign('encounterId')->references('encounterId')->on('encounters')->onDelete('cascade');
            $table->foreign('createdBy')->references('id')->on('users')->onDelete('cascade');
        });


        // Schema::table('encounters', function (Blueprint $table) {
        //     $table->unsignedBigInteger('consultingId')->nullable();
        //     $table->unsignedBigInteger('continueConsultingId')->nullable();
        //     $table->unsignedBigInteger('sketchId')->nullable();
        //     $table->unsignedBigInteger('diagnosisId')->nullable();
        //     $table->unsignedBigInteger('investigationId')->nullable();
        //     $table->unsignedBigInteger('treatmentId')->nullable();
        //     $table->unsignedBigInteger('appointmentId')->nullable();
        //     $table->unsignedBigInteger('refractionId')->nullable();
            
        //         $table->foreign('consultingId')->references('consultingId')->on('consulting')->onDelete('cascade');
        //         $table->foreign('continueConsultingId')->references('continueConsultingId')->on('continue_consulting')->onDelete('cascade');
        //         $table->foreign('sketchId')->references('sketchId')->on('sketch')->onDelete('cascade');
        //         $table->foreign('diagnosisId')->references('diagnosisId')->on('diagnosis')->onDelete('cascade');
        //         $table->foreign('investigationId')->references('investigationId')->on('investigations')->onDelete('cascade');
        //         $table->foreign('appointmentId')->references('appointmentId')->on('appointments')->onDelete('cascade');
        //         $table->foreign('refractionId')->references('refractionId')->on('refractions')->onDelete('cascade');
        //     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
