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
        Schema::create('patient_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('form_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('social_worker_id');
            $table->json('response');
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('form_id')->references('id')->on('forms');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('social_worker_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_forms');
    }
};
