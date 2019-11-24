<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VUbicacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //if (Schema::hasTable('vUbicacion')) 
        DB::connection()->getpdo()->exec('DROP VIEW IF EXISTS vUbicacion;');
        DB::connection()->getpdo()->exec("
            CREATE VIEW vUbicacion 
            AS
                SELECT 
                    ubi.idUbicacion, ubi.titulo, ubi.descripcion, ubi.pathUbicacion, ubi.created_at, ubi.updated_at, 
                    ubi.idCiudad,
                    ci.titulo as tituloCiudad,
                    concat(ci.titulo, ', ', es.titulo, ', ', pa.titulo) as tituloCiudadCompleta,
                    ubi.idUsuario,
                    us.name,
                    us.pathAvatar,
                    fnObtenerAntiguedad(ubi.created_at) as antiguedad
                FROM tbl_ubicacion as ubi
                inner join tbl_ciudad as ci on ci.idCiudad = ubi.idCiudad
                inner join tbl_estado as es on ci.idEstado = es.idEstado
                inner join tbl_pais as pa on pa.idPais = es.idPais
                inner join users as us on us.id = ubi.idUsuario
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
         DB::connection()->getpdo()->exec('DROP VIEW IF EXISTS vListaPublicacion;');
    }
}
