<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataGraphsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_graphs', function (Blueprint $table) {
            $table->id();
            $table->string('cnes')->nullable();
            $table->string('health_unit')->nullable();
            $table->string('county')->nullable();
            $table->string('health_region')->nullable();
            $table->string('cardiology')->nullable();
            $table->string('endocrinology_and_metabology')->nullable();
            $table->string('nursing')->nullable();
            $table->string('family_and_community_medicine')->nullable();
            $table->string('physiatry')->nullable();
            $table->string('neurology')->nullable();
            $table->string('neuropediatrics')->nullable();
            $table->string('nutritionist')->nullable();
            $table->string('psychiatry')->nullable();
            $table->string('child_and_adolescent_psychiatry')->nullable();
            $table->string('urology')->nullable();
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
        Schema::dropIfExists('data_graphs');
    }
}
