<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProadisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proadis', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('text', 255)->nullable();
            $table->string('path_image', 191)->nullable();
            $table->tinyInteger('active')->default(0);
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
        Schema::dropIfExists('proadis');
    }
}
