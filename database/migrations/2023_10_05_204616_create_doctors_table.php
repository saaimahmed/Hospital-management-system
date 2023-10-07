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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('dr_id');
            $table->string('dr_name');
            $table->string('dr_department');
            $table->string('dr_designation');
            $table->string('dr_email')->nullable();
            $table->string('dr_phone');
            $table->string('image')->nullable();
            $table->text('dr_biography')->nullable();
            $table->text('dr_specialization')->nullable();
            $table->text('dr_experience')->nullable();
            $table->text('dr_qualification')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 => Active , 0 => Deactivated');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
