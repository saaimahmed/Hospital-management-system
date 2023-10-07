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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->string('schedule_days');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('maximum_patient')->nullable();
            $table->string('new_patient_fee');
            $table->string('old_patient_fee')->nullable();
            $table->string('report_fee')->nullable();
            $table->tinyInteger('status')->default(1)->comment(' 1 => Active , 0 => deactivated');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
