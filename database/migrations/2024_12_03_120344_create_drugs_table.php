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
        // Schema::create('manufacturers', function (Blueprint $table) {
        //     $table->id('manufacturerId');
        //     $table->string('manufacturerName')->nullable();
        //     $table->timestamps();
        // });

        Schema::create('medicines', function (Blueprint $table) {
            $table->id('medicineId');
            $table->string('medicineName')->nullable();
            $table->string('formulation')->nullable();
            $table->string('quantity')->nullable();
            $table->unsignedBigInteger('manufacturer')->nullable();
            $table->enum('status', ['active', 'disabled'])->default('active')->nullable();
            $table->string('type')->nullable();
            $table->string('price')->nullable();
            $table->timestamps();

            $table->foreign('manufacturer')->references('manufacturerId')->on('manufacturers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drugs');
    }
};
