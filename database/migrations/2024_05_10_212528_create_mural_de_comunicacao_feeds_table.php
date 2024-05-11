<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuralDeComunicacaoFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mural_de_comunicacao_feeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mural_category_id')->constrained('mural_de_comunicacao_categories')->onDelete('cascade');
            $table->string('title', 191)->nullbale();
            $table->text('description', 191)->nullable();
            $table->text('text')->nullable();
            $table->boolean('active')->default(0);
            $table->integer('sorting')->default(0);
            $table->date('publish_date')->nullable();
            $table->string('path_image', 191)->nullbale();
            $table->string('btn_title')->nullable();
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
        Schema::dropIfExists('mural_de_comunicacao_feeds');
    }
}
