<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chronic_diseases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('measure');
            $table->date('date');
            $table->longtext('notes')->nullable();
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
        Schema::dropIfExists('chronic_diseases');
    }
};
