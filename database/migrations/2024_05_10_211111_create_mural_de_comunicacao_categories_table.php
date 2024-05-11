<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuralDeComunicacaoCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mural_de_comunicacao_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191)->nullable();
            $table->string('slug', 191)->nullable();
            $table->integer('sorting')->default(0);
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('mural_de_comunicacao_categories');
    }
}
