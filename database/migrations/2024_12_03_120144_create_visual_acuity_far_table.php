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
        Schema::create('visual_acuity_far', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('status', ['active', 'disabled'])->default('active')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visual_acuity_far');
    }
};
