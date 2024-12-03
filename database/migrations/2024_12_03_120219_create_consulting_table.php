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
        Schema::create('consulting', function (Blueprint $table) {

            $table->id('consultingId');
$table->unsignedBigInteger('patientId')->nullable();
$table->unsignedBigInteger('encounterId')->nullable();
$table->unsignedBigInteger('visualAcuityFarPresentingRight')->nullable();
$table->unsignedBigInteger('visualAcuityFarPresentingLeft')->nullable();
$table->unsignedBigInteger('visualAcuityFarPinholeRight')->nullable();
$table->unsignedBigInteger('visualAcuityFarPinholeLeft')->nullable();
$table->unsignedBigInteger('visualAcuityFarBestCorrectedRight')->nullable();
$table->unsignedBigInteger('visualAcuityFarBestCorrectedLeft')->nullable();
$table->unsignedBigInteger('visualAcuityNearRight')->nullable();
$table->unsignedBigInteger('visualAcuityNearLeft')->nullable();
$table->timestamps();
$table->softDeletes();
$table->foreign('patientId')->references('patientId')->on('patients')->onDelete('cascade');
$table->foreign('encounterId')->references('encounterId')->on('encounters')->onDelete('cascade');
$table->foreign('visualAcuityFarPresentingRight')->references('id')->on('visual_acuity_far')->onDelete('cascade');
$table->foreign('visualAcuityFarPresentingLeft')->references('id')->on('visual_acuity_far')->onDelete('cascade');
$table->foreign('visualAcuityFarPinholeRight')->references('id')->on('visual_acuity_far')->onDelete('cascade');
$table->foreign('visualAcuityFarPinholeLeft')->references('id')->on('visual_acuity_far')->onDelete('cascade');
$table->foreign('visualAcuityFarBestCorrectedRight')->references('id')->on('visual_acuity_far')->onDelete('cascade');
$table->foreign('visualAcuityFarBestCorrectedLeft')->references('id')->on('visual_acuity_far')->onDelete('cascade');
$table->foreign('visualAcuityNearRight')->references('id')->on('visual_acuity_near')->onDelete('cascade');
$table->foreign('visualAcuityNearLeft')->references('id')->on('visual_acuity_near')->onDelete('cascade');

        
  


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consulting');
    }
};
