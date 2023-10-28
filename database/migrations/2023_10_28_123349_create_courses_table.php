<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->string('title', 191)->nullable();
            $table->text('text')->nullable();
            $table->string('slug', 191);
            $table->string('path_image'. 255)->nullable();
            $table->string('link_youtube', 255)->nullable();
            $table->string('link_vimeo', 255)->nullable();
            $table->text('video')->nullable();
            $table->integer('sorting')->default(0);
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
        Schema::dropIfExists('courses');
    }
}
