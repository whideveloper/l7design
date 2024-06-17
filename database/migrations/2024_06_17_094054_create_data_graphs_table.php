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
            $table->integer('cnes')->nullable();
            $table->string('health_unit')->nullable();
            $table->string('district')->nullable();
            $table->string('county')->nullable();
            $table->integer('health_region')->nullable();
            $table->integer('cardiology')->nullable();
            $table->integer('endocrinology_and_metabology')->nullable();
            $table->integer('nursing')->nullable();
            $table->integer('family_and_community_medicine')->nullable();
            $table->integer('physiatry')->nullable();
            $table->integer('neurology')->nullable();
            $table->integer('neuropediatrics')->nullable();
            $table->integer('nutritionist')->nullable();
            $table->integer('psychiatry')->nullable();
            $table->integer('child_and_adolescent_psychiatry')->nullable();
            $table->integer('urology')->nullable();
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
