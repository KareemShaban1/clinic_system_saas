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
        Schema::create('service_fees', function (Blueprint $table) {
            $table->id();
            $table->string('service_name');
            // $table->foreignId('clinic_id')->references('id')->on('clinics')->onDelete('cascade');

             // Make the user morphable to any 'organization' model
             $table->nullableMorphs('organization'); 
             // (clinics , medical_laboratories , radiology_centers)    
            // Creates organization_id (unsignedBigInteger) and organization_type (string)
            
            $table->decimal('fee', 10, 2);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('service_fees');
    }
};
