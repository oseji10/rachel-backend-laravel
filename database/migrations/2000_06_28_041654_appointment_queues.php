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
         Schema :: create('appointment_queues', function (Blueprint $table) {
            $table -> id('queueId');
            $table -> unsignedBigInteger('patientId') -> nullable();
            $table -> string('queueNumber') -> nullable();
            $table -> string('attendedTo') -> nullable();
            $table -> unsignedBigInteger('scheduledBy') -> nullable();
            $table -> timestamps();

            $table->foreign('patientId')->references('patientId')->on('patients');
            $table->foreign('scheduledBy')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
