<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_analysis', function (Blueprint $table) {
            $table->id();
            $table->string('analysis_name');
            $table->string('images')->nullable();
            $table->date('analysis_date');
            $table->string('analysis_type');
            $table->longText('report')->nullable();
            $table->foreignId('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
            $table->foreignId('reservation_id')->references('reservation_id')->on('reservations')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_analysis');
    }
};