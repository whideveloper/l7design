<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnLinkMuralDeComunicacaoFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mural_de_comunicacao_feeds', function (Blueprint $table) {
            $table->string('link', 2048)->nullable()->change();
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
            $table->string('link', 2048)->nullable(false)->change();
        });
    }
}
