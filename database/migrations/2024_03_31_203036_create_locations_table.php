<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191)->nullable();
            $table->text('description', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->tinyInteger('active')->default(0);
            $table->integer('sorting')->default(0);
            $table->integer('number_county')->nullable();
            $table->integer('number_region')->nullable();
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
        Schema::dropIfExists('locations');
    }
}
