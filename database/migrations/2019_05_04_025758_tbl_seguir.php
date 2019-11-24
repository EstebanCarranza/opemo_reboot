<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblSeguir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('tbl_seguir');
        Schema::create('tbl_seguir', function (Blueprint $table) {
            $table->increments('idSeguir');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->integer('idUsuarioSeguidor')->unsigned();
            $table->integer('idUsuarioSiguiendo')->unsigned();

            $table->foreign('idUsuarioSeguidor','fk_usuarioSeguidorK')->references('id')->on('users');
            $table->foreign('idUsuarioSiguiendo','fk_usuarioSiguiendoK')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('tbl_seguir');
    }
}
