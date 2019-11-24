<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VPublicacionList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasTable('vListaPublicacion')) 
            DB::statement('DROP VIEW IF EXISTS vListaPublicacion;');
        \DB::statement("
            CREATE VIEW vListaPublicacion 
            AS
               select 
                    pub.idPublicacion, 
                    pub.idUsuario, us.name,
                    pub.idUbicacion, ub.titulo as tituloUbicacion,
                    pub.idPublicacionEstado, pe.titulo as tituloPublicacionEstado,
                    ub.idCiudad, ci.titulo as tituloCiudad,
                    concat(ci.titulo, ', ', es.titulo, ', ', pa.titulo) as tituloCiudadCompleto,
                    pub.titulo as tituloPublicacion, pub.pathImgVideo, pub.fecha, pub.hora, pub.descripcion, pub.created_at, pub.updated_at, pub.pathVistaPrevia,
                    fnObtenerAntiguedad(pub.created_at) as antiguedad
                    From tbl_publicacion as pub
                    inner join users as us on pub.idUsuario = us.id
                    inner join tbl_ubicacion as ub on pub.idUbicacion = ub.idUbicacion
                    inner join tbl_publicacionEstado as pe on pub.idPublicacionEstado = pe.idPublicacionEstado
                    inner join tbl_ciudad as ci on ub.idCiudad = ci.idCiudad
                    inner join tbl_estado as es on es.idEstado = ci.idEstado
                    inner join tbl_pais as pa on pa.idPais = es.idPais
                    ;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
         DB::statement('DROP VIEW IF EXISTS vListaPublicacion;');
    }
}
