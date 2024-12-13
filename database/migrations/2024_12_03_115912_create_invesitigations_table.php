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
        Schema::create('investigations', function (Blueprint $table) {
            $table->id('investigationId');
            $table->unsignedBigInteger('patientId')->nullable();
            $table->unsignedBigInteger('encounterId')->nullable();
            $table->text('investigationsRequired')->nullable();
            $table->text('externalInvestigationRequired')->nullable();
            $table->text('investigationsDone')->nullable();
            $table->string('HBP')->nullable();
            $table->string('diabetes')->nullable();
            $table->string('pregnancy')->nullable();
            $table->string('drugAllergy')->nullable();
            $table->string('currentMedication')->nullable();
            $table->unsignedBigInteger('documentId')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patientId')->references('patientId')->on('patients')->onDelete('cascade');
            $table->foreign('encounterId')->references('encounterId')->on('encounters')->onDelete('cascade');
            $table->foreign('documentId')->references('documentId')->on('document_upload')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invesitigations');
    }
};
