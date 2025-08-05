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
        Schema::create('refractions', function (Blueprint $table) {
            $table->id('refractionId');
            $table->unsignedBigInteger('patientId')->nullable();
            $table->string('encounterId')->nullable();
            $table->string('pd')->nullable();
            $table->string('bridge')->nullable();
            $table->string('eyeSize')->nullable();
            $table->string('temple')->nullable();
            $table->string('decentration')->nullable();
            $table->string('segmentMeasurement')->nullable();
            $table->string('frameType')->nullable();
            $table->string('frameColor')->nullable();
            $table->string('frameCost')->nullable();
            $table->string('lensType')->nullable();
            $table->string('lensColor')->nullable();
            $table->string('lensCost')->nullable();
            $table->string('other')->nullable();
            $table->string('surfacing')->nullable();
            $table->string('caseSize')->nullable();

           
            $table->unsignedBigInteger('nearAddRight')->nullable();
            $table->unsignedBigInteger('nearAddLeft')->nullable();

            $table->unsignedBigInteger('refractionSphereRight')->nullable();
            $table->unsignedBigInteger('refractionSphereLeft')->nullable();
            $table->unsignedBigInteger('refractionCylinderRight')->nullable();
            $table->unsignedBigInteger('refractionCylinderLeft')->nullable();
            $table->unsignedBigInteger('refractionAxisRight')->nullable();
            $table->unsignedBigInteger('refractionAxisLeft')->nullable();
            $table->unsignedBigInteger('refractionPrismRight')->nullable();
            $table->unsignedBigInteger('refractionPrismLeft')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patientId')->references('patientId')->on('patients')->onDelete('cascade');
            // $table->foreign('encounterId')->references('encounterId')->on('encounters')->onDelete('cascade');
            $table->foreign('nearAddRight')->references('id')->on('refraction_sphere')->onDelete('cascade');
            $table->foreign('nearAddLeft')->references('id')->on('refraction_sphere')->onDelete('cascade');

            $table->foreign('refractionSphereRight')->references('id')->on('refraction_sphere')->onDelete('cascade');
            $table->foreign('refractionSphereLeft')->references('id')->on('refraction_sphere')->onDelete('cascade');
            $table->foreign('refractionCylinderRight')->references('id')->on('refraction_cylinder')->onDelete('cascade');
            $table->foreign('refractionCylinderLeft')->references('id')->on('refraction_cylinder')->onDelete('cascade');
            $table->foreign('refractionAxisRight')->references('id')->on('refraction_axis')->onDelete('cascade');
            $table->foreign('refractionAxisLeft')->references('id')->on('refraction_axis')->onDelete('cascade');
            $table->foreign('refractionPrismRight')->references('id')->on('refraction_prism')->onDelete('cascade');
            $table->foreign('refractionPrismLeft')->references('id')->on('refraction_prism')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sketch');
    }
};
