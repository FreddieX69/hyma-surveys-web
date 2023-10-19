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
        Schema::create('patient_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_form_id');
            $table->unsignedBigInteger('field_id');
            $table->unsignedBigInteger('field_answer_id')->nullable();
            $table->text('answer')->nullable();
            $table->foreign('patient_form_id')->references('id')->on('patient_forms');
            $table->foreign('field_id')->references('id')->on('fields');
            $table->foreign('field_answer_id')->references('id')->on('field_answers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_responses');
    }
};
