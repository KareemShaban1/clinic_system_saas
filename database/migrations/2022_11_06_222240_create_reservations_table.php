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
            $table->id('id');
            $table->foreignId('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->foreignId('doctor_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('clinic_id')->references('id')->on('clinics')->cascadeOnDelete();
            $table->string('reservation_number')->nullable();
            $table->string('slot')->nullable();
            $table->longText('first_diagnosis')->nullable();
            $table->longText('final_diagnosis')->nullable();
            $table->enum('type', ['check', 'recheck' ,'consultation','other'])->default('check');
            $table->string('cost')->nullable();
            $table->enum('payment', ['paid', 'not paid'])->default('not paid');
            $table->date('date');
            $table->string('month');
            $table->enum('status',['waiting','entered','finished','cancelled'])->default('waiting');
            $table->enum('acceptance',['approved','not_approved'])->default('not_approved');
            $table->softDeletes();
            $table->timestamps();
            
            // $table->unsignedBigInteger('id');
            // $table->foreign('id')->references('id')->on('patients')->onDelete('cascade');
           
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
