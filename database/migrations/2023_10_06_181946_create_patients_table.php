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
            $table->id();
            $table->string('patient_name');
            $table->string('patient_mobile');
            $table->string('patient_email')->nullable();
            $table->string('patient_gender');
            $table->string('patient_blood_group')->nullable();
            $table->string('patient_age')->nullable();
            $table->string('unit')->nullable();
            $table->text('patient_address')->nullable();
            $table->timestamps();
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
