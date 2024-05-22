<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsNameAndImageInEspecialidadeProfessionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('especialidade_professionals', function (Blueprint $table) {
            $table->string('name', 191)->nullable()->change();
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
        Schema::table('especialidade_professionals', function (Blueprint $table) {
            $table->string('name', 191)->nullable(false)->change();
            $table->string('path_image', 191)->nullable(false)->change();
        });
    }
}
