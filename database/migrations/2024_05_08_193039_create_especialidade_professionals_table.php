<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspecialidadeProfessionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especialidade_professionals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('especialidade_category_id')->constrained('especialidade_categories');
            $table->string('name', 191)->nullbale();
            $table->string('path_image', 191)->nullbale();
            $table->text('crm', 191)->nullable();
            $table->text('description', 191)->nullable();
            $table->text('text')->nullable();
            $table->boolean('active')->default(0);
            $table->integer('sorting')->default(0);
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
        Schema::dropIfExists('especialidade_professionals');
    }
}
