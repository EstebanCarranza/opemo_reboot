<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VPublicacionReportada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //if (Schema::hasTable('vPublicacionReportada')) 
            DB::connection()->getpdo()->exec('DROP VIEW IF EXISTS vPublicacionReportada;');
        
        DB::connection()->getpdo()->exec("
            CREATE VIEW vPublicacionReportada 
            as
            SELECT 
                prl.idPublicacionReportada,
                prl.created_at,
                prl.updated_at,
                prl.idPublicacion,
                pub.titulo as tituloPublicacion,
                prl.idRazonReporte,
                rar.titulo as tituloRazonReporte,
                usr.id,
                usr.name as nombreUsuario
            FROM 
            tbl_publicacionReportada as prl
            inner join tbl_publicacion as pub on pub.idPublicacion = prl.idPublicacion
            inner join tbl_razonReporte as rar on rar.idRazonReporte = prl.idRazonReporte
            inner join users as usr on usr.id = pub.idUsuario
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
        DB::connection()->getpdo()->exec('DROP VIEW IF EXISTS vSeguir;');
    }
}
