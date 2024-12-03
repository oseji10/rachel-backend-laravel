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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('patientId');
            $table->string('hospitalFileNumber')->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('otherNames')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('bloodGroup')->nullable();
            $table->string('occupation')->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('doctor')->nullable();
            $table->enum('status', ['active', 'disabled'])->default('active')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('doctor')->references('doctorId')->on('doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
