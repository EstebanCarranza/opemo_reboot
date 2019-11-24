<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPublicacionReclamada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_publicacionReclamada');
         Schema::create('tbl_publicacionReclamada', function (Blueprint $table) {
            $table->increments('idPublicacionReclamada');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->integer('idUsuarioReclamador')->unsigned();
            $table->integer('idPublicacion')->unsigned();
            $table->text('descripcion');

            $table->foreign('idUsuarioReclamador','fk_usuarioReclamadorK')->references('id')->on('users');
            $table->foreign('idPublicacion','fk_usuarioPublicacionK')->references('idPublicacion')->on('tbl_publicacion');

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
        Schema::dropIfExists('tbl_publicacionReclamada');
    }
}
