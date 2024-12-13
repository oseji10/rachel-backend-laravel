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
        Schema::create('treatment', function (Blueprint $table) {
            $table->id('treatmentId');
            $table->unsignedBigInteger('patientId')->nullable();
            $table->unsignedBigInteger('encounterId')->nullable();
            $table->string('treatmentType')->nullable();
            $table->string('dosage')->nullable();
            $table->string('doseDuration')->nullable();
            $table->string('doseInterval')->nullable();
            $table->string('time')->nullable();
            $table->string('comment')->nullable();
            $table->string('lensType')->nullable();
            $table->string('costOfLens')->nullable();
            $table->string('costOfFrame')->nullable();
            $table->timestamps();

            $table->foreign('patientId')->references('patientId')->on('patients')->onDelete('cascade');
            $table->foreign('encounterId')->references('encounterId')->on('encounters')->onDelete('cascade');

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
