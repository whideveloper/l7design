<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnPathImageMuralDeComunicacaoFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mural_de_comunicacao_feeds', function (Blueprint $table) {
            $table->string('path_image', 191)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mural_de_comunicacao_feeds', function (Blueprint $table) {
            $table->string('path_image', 191)->nullable(false)->change();
        });
    }
}
