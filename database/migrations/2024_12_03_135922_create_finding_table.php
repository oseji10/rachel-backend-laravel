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
        Schema::create('findings', function (Blueprint $table) {
            $table->id('findingId');
            $table->unsignedBigInteger('patientId')->nullable();
            $table->unsignedBigInteger('encounterId')->nullable();
        
            $table->text('OCTRight')->nullable();
            $table->text('OCTLeft')->nullable();
            $table->text('FFARight')->nullable();
            $table->text('FFALeft')->nullable();
            $table->text('fundusPhotographyRight')->nullable();
            $table->text('fundusPhotographyLeft')->nullable();
            $table->text('pachymetryRight')->nullable();
            $table->text('pachymetryLeft')->nullable();
            $table->text('CUFTRight')->nullable();
            $table->text('CUFTLeft')->nullable();
            $table->text('CUFTKineticRight')->nullable();
            $table->text('CUFTKineticLeft')->nullable();
            $table->text('pupilRight')->nullable();
            $table->text('pupilLeft')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patientId')->references('patientId')->on('patients')->onDelete('cascade');
            $table->foreign('encounterId')->references('encounterId')->on('encounters')->onDelete('cascade');
           
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
