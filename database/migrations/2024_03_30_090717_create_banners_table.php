<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191)->nullable();
            $table->string('subtitle', 191)->nullable();
            $table->string('link', 191)->nullable();
            $table->tinyInteger('active')->default(0);
            $table->integer('sorting')->default(0);
            $table->string('path_image', 191)->nullable();
            $table->string('path_image_mobile', 191)->nullable();
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
        Schema::dropIfExists('banners');
    }
}
