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
        Schema::create('online_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->boolean('integration');
            $table->foreignId('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            // $table->foreignId('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->string('meeting_id');
            $table->string('topic');
            $table->dateTime('start_at');
            $table->integer('duration')->comment('minutes');
            $table->string('password')->comment('meeting password');
            $table->text('start_url');
            $table->text('join_url');

            $table->longText('first_diagnosis')->nullable();

            $table->longText('final_diagnosis')->nullable();

            $table->enum('type', ['check', 'recheck', 'consultation'])->default('check');

            $table->string('cost')->nullable();

            $table->enum('payment', ['paid', 'not paid'])->default('not paid');


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
        Schema::dropIfExists('online_reservations');
    }
};
