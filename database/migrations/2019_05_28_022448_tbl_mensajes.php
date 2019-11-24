<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblMensajes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::dropIfExists('tbl_mensajes');
         Schema::create('tbl_mensajes', function (Blueprint $table) {
            $table->increments('idMensaje');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->integer('idPublicacionReclamada')->unsigned();
            $table->integer('idUsuario1')->unsigned();
            $table->integer('idUsuario2')->unsigned();
            $table->text('mensaje');

            $table->foreign('idUsuario1','fk_usuario1')->references('id')->on('users');
            $table->foreign('idUsuario2','fk_usuario2')->references('id')->on('users');
            $table->foreign('idPublicacionReclamada')->references('idPublicacionReclamada')->on('tbl_publicacionReclamada');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_mensajes');
    }
}
