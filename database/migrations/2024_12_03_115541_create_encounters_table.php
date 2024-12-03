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
            
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('patientId')->references('patientId')->on('patients')->onDelete('cascade');
            
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
