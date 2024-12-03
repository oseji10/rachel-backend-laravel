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
        Schema::create('continue_consulting', function (Blueprint $table) {
            $table->id('continueConsultingId');
            $table->unsignedBigInteger('patientId')->nullable();
            $table->unsignedBigInteger('encounterId')->nullable();
            $table->text('intraOccularPressureRight')->nullable();
            $table->text('intraOccularPressureLeft')->nullable();
            $table->text('otherComplaintsRight')->nullable();
            $table->text('otherComplaintsLeft')->nullable();
            $table->text('detailedHistoryRight')->nullable();
            $table->text('detailedHistoryLeft')->nullable();
            $table->text('findingsRight')->nullable();
            $table->text('findingsLeft')->nullable();
            $table->text('eyelidRight')->nullable();
            $table->text('eyelidLeft')->nullable();
            $table->text('conjunctivaRight')->nullable();
            $table->text('conjunctivaLeft')->nullable();
            $table->text('corneaRight')->nullable();
            $table->text('corneaLeft')->nullable();
            $table->text('ACRight')->nullable();
            $table->text('ACLeft')->nullable();
            $table->text('irisRight')->nullable();
            $table->text('irisLeft')->nullable();
            $table->text('pupilRight')->nullable();
            $table->text('pupilLeft')->nullable();
            $table->text('lensRight')->nullable();
            $table->text('lensLeft')->nullable();
            // $table->string('lensRight')->nullable();
            $table->text('vitreousRight')->nullable();
            $table->text('vitreousLeft')->nullable();
            $table->text('retinaRight')->nullable();
            $table->text('retinaLeft')->nullable();
            $table->text('otherFindingsRight')->nullable();
            $table->text('otherFindingsLeft')->nullable();
            $table->unsignedBigInteger('chiefComplaintRight')->nullable();
            $table->unsignedBigInteger('chiefComplaintLeft')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('patientId')->references('patientId')->on('patients')->onDelete('cascade');
            $table->foreign('encounterId')->references('encounterId')->on('encounters')->onDelete('cascade');
            $table->foreign('chiefComplaintRight')->references('id')->on('chief_complaint')->onDelete('cascade');
            $table->foreign('chiefComplaintLeft')->references('id')->on('chief_complaint')->onDelete('cascade');
            
            
        });

    

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('continue_consulting');
    }
};
