<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 

    public function up()
{
    Schema::create('sketch', function (Blueprint $table) {
        $table->id('sketchId');
        $table->unsignedBigInteger('patientId')->nullable();
        $table->unsignedBigInteger('encounterId')->nullable();
        $table->string('right_eye_front');
        $table->string('right_eye_back');
        $table->string('left_eye_front');
        $table->string('left_eye_back');
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
