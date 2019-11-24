<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitBD extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function dropTables()
    {
        Schema::dropIfExists('tbl_testimonio');
        Schema::dropIfExists('tbl_comentario');
        Schema::dropIfExists('tbl_publicacionReportada');
        Schema::dropIfExists('tbl_razonReporte');
        Schema::dropIfExists('tbl_recuperado');
        Schema::dropIfExists('tbl_mensaje');
        Schema::dropIfExists('tbl_puntuacion');
        Schema::dropIfExists('tbl_publicacion');
        Schema::dropIfExists('tbl_publicacionEstado');
        Schema::dropIfExists('tbl_ubicacion');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
        Schema::dropIfExists('tbl_ciudad');
        Schema::dropIfExists('tbl_estado');
        Schema::dropIfExists('tbl_pais');
        
    }
    public function up()
    {
        //
        $timestamps = true;
        //Schema::enableForeignKeyConstraints();
        $this->dropTables();
        Schema::create('tbl_pais', function (Blueprint $table) {
            $table->increments('idPais');
            $table->string('titulo',100);
            $table->timestamps();
        });
        Schema::create('tbl_estado', function (Blueprint $table) {
            $table->increments('idEstado');
            $table->string('titulo',100);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->integer('idPais')->unsigned();

            $table->foreign('idPais','fk_paisEstado')->references('idPais')->on('tbl_pais');
        });
        Schema::create('tbl_ciudad', function (Blueprint $table) {
            $table->increments('idCiudad');
            $table->string('titulo',100);
            $table->boolean('areaMetropolitana')->default(false);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->integer('idEstado')->unsigned();

            $table->foreign('idEstado','fk_estadoCiudad')->references('idEstado')->on('tbl_estado');
        });
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email',50)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('alias',10)->nullable();
            $table->string('nombre',50)->nullable();
            $table->string('apellido_pat',50)->nullable();            
            $table->string('pathAvatar', 255)->default('defaultData/avatar.png');
            $table->string('pathPortada',255)->default('defaultData/cover.png');
            $table->string('bio',255)->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->boolean('bloqueado')->default(0);
        });
         Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email',50)->index();
            $table->string('token');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::create('tbl_ubicacion', function (Blueprint $table) {
            $table->increments('idUbicacion');
            $table->string('titulo');
            $table->text('descripcion');
            $table->text('pathUbicacion');
            
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->integer('idCiudad')->unsigned();
            $table->integer('idUsuario')->unsigned();

            $table->foreign('idCiudad','fk_ciudadUbicacion')->references('idCiudad')->on('tbl_ciudad');
            $table->foreign('idUsuario','fk_usuarioUbicacion')->references('id')->on('users');
        });
        Schema::create('tbl_publicacionEstado', function (Blueprint $table) {
            $table->increments('idPublicacionEstado');
            $table->string('titulo');
            $table->timestamps();
        });
        Schema::create('tbl_publicacion', function (Blueprint $table) {
            $table->increments('idPublicacion');
            $table->string('titulo');
            $table->text('pathImgVideo');
            $table->text('pathVistaPrevia');
            $table->date('fecha');
            $table->time('hora');
            $table->text('descripcion');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->integer('idUbicacion')->unsigned();
            $table->integer('idPublicacionEstado')->unsigned();
            $table->integer('idUsuario')->unsigned();

            $table->foreign('idUbicacion','fk_ubicacionPublicacion')->references('idUbicacion')->on('tbl_ubicacion');
            $table->foreign('idPublicacionEstado','fk_pubEstadoPublicacion')->references('idPublicacionEstado')->on('tbl_publicacionEstado');
            $table->foreign('idUsuario','fk_usuarioPublicacion')->references('id')->on('users');

        });
        Schema::create('tbl_puntuacion', function (Blueprint $table) {
            $table->increments('idPuntuacion');
            $table->enum('puntuacion',['1','2','3','4','5']);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
             
            $table->integer('idUsuario')->unsigned();
            $table->integer('idPublicacion')->unsigned();

            $table->foreign('idUsuario','fk_usuarioPuntuacion')->references('id')->on('users');
            $table->foreign('idPublicacion','fk_publicacionPuntuacion')->references('idPublicacion')->on('tbl_publicacion');
        });
        Schema::create('tbl_recuperado', function (Blueprint $table) {
            $table->increments('idRecuperado');
            
            $table->string('titulo');
            $table->text('pathImgVideo');
            $table->date('fecha');
            $table->time('hora');
            $table->text('descripcion');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->integer('idUsuario')->unsigned();
            $table->integer('idUbicacion')->unsigned();
            $table->integer('idCiudad')->unsigned();

            $table->foreign('idUsuario','fk_usuarioRecuperado')->references('id')->on('users');
            $table->foreign('idUbicacion','fk_ubicacionRecuperado')->references('idUbicacion')->on('tbl_ubicacion');
            $table->foreign('idCiudad','fk_ciudadRecuperado')->references('idCiudad')->on('tbl_ciudad');

        });
        Schema::create('tbl_mensaje', function (Blueprint $table) {
            $table->increments('idMensaje');
            $table->text('mensaje');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->integer('idUsuario')->unsigned();
            $table->integer('idPublicacion')->unsigned();

            $table->foreign('idUsuario','fk_usuarioMensaje')->references('id')->on('users');
            $table->foreign('idPublicacion','fk_publicacionMensaje')->references('idPublicacion')->on('tbl_publicacion');

        });
        Schema::create('tbl_razonReporte', function (Blueprint $table) {
            $table->increments('idRazonReporte');
            $table->string('titulo');
            $table->timestamps();
            
        });
        Schema::create('tbl_publicacionReportada', function (Blueprint $table) {
            $table->increments('idPublicacionReportada');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->integer('idPublicacion')->unsigned();
            $table->integer('idRazonReporte')->unsigned();

            $table->foreign('idPublicacion','fk_publicacionPubReportada')->references('idPublicacion')->on('tbl_publicacion');
            $table->foreign('idRazonReporte','fk_razonReportePubReportada')->references('idRazonReporte')->on('tbl_razonReporte');

        });
        Schema::create('tbl_comentario', function (Blueprint $table) {
            $table->increments('idComentario');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->integer('idUsuario')->unsigned();
            $table->integer('idPublicacion')->unsigned();

            $table->foreign('idUsuario','fk_usuarioComentario')->references('id')->on('users');
            $table->foreign('idPublicacion','fk_publicacionComentario')->references('idPublicacion')->on('tbl_publicacion');

        });
        Schema::create('tbl_testimonio', function (Blueprint $table) {
            $table->increments('idTestimonio');
            $table->string('titulo');
            $table->string('descripcion');
            $table->boolean('mostrarTestimonio');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('tbl_testimonio');
        Schema::dropIfExists('tbl_comentario');
        Schema::dropIfExists('tbl_publicacionReportada');
        Schema::dropIfExists('tbl_razonReporte');
        Schema::dropIfExists('tbl_recuperado');
        Schema::dropIfExists('tbl_mensaje');
        Schema::dropIfExists('tbl_puntuacion');
        Schema::dropIfExists('tbl_publicacion');
        Schema::dropIfExists('tbl_publicacionEstado');
        Schema::dropIfExists('tbl_ubicacion');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
        Schema::dropIfExists('tbl_ciudad');
        Schema::dropIfExists('tbl_estado');
        Schema::dropIfExists('tbl_pais');
        
    }
}
