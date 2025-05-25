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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('image')->nullable();
            $table->string('age')->nullable();
            $table->string('address');
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('patient_code')->unique();
            $table->char('phone', 20)->unique();
            $table->char('whatsapp_number', 20)->nullable();
            $table->enum('blood_group', 
            ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'])->nullable();
            $table->enum('gender', ['male', 'female']);
            // new updates 24/9/2023
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->enum('marital_status',
             ['single', 'married', 'widowed', 'divorced', 'separated'])->nullable();
            // $table->string('nationality')->nullable();
            // end new updates
            // $table->foreignId('clinic_id')->references('id')->on('clinics')->onDelete('cascade');

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
        Schema::dropIfExists('patients');
    }
};
