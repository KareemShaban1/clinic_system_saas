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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->foreignId('patient_id')->references('patient_id')->on('patients')->cascadeOnDelete();
            $table->string('res_num');
            $table->longText('first_diagnosis')->nullable();
            $table->longText('final_diagnosis')->nullable();
            $table->enum('res_type', ['check', 'recheck' ,'consultation'])->default('check');
            $table->string('cost')->nullable();
            $table->enum('payment', ['paid', 'not paid'])->default('not paid');
            $table->date('res_date');
            $table->string('month');
            $table->enum('status',['waiting','entered','finished'])->default('waiting');
            $table->softDeletes();
            $table->timestamps();
            
            // $table->unsignedBigInteger('patient_id');
            // $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
