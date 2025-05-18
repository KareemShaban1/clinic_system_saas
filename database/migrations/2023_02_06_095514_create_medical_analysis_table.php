<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_analysis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('reservation_id')->nullable()->constrained('reservations')->nullOnDelete();
            
            
            // Make the user morphable to any 'organization' model
            $table->nullableMorphs('organization');
            // (clinics , medical_laboratories , radiology_centers)    
            // Creates organization_id (unsignedBigInteger) and organization_type (string)

            $table->string('name');
            // $table->string('images')->nullable();
            $table->date('date');
            $table->string('cost')->nullable();
            $table->enum('payment', ['paid', 'not paid'])->default('not paid');

            // $table->string('type');
            // $table->foreignId('type_id')->nullable()->references('id')->on('types')
            //     ->nullOnDelete();
            $table->longText('report')->nullable();

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
