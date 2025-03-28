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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('drugbank_id')->nullable();
            $table->string('name')->nullable();
            $table->longtext('brand_name')->nullable();
            $table->string('drug_dose')->nullable();
            $table->string('type')->nullable();
            $table->string('group')->nullable();
            $table->string('categories')->nullable();
            $table->longtext('description')->nullable();
            $table->longtext('side_effect')->nullable();
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
        Schema::dropIfExists('medicine');
    }
};
