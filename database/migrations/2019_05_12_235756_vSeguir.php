<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VSeguir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //if (Schema::hasTable('vSeguir')) 
            DB::connection()->getpdo()->exec('DROP VIEW IF EXISTS vSeguir;');
        DB::connection()->getpdo()->exec("
            create view vSeguir
            as
            SELECT 
                seg.idSeguir, 
                seg.created_at, 
                seg.updated_at, 
                seg.idUsuarioSeguidor, 
                uSeguidor.name as nombreSeguidor,
                seg.idUsuarioSiguiendo,
                uSiguiendo.name as nombreSiguiendo,
                fnObtenerAntiguedad(seg.created_at) as antiguedad
            FROM tbl_seguir as seg
            inner join users as uSeguidor on uSeguidor.id = seg.idUsuarioSeguidor
            inner join users as uSiguiendo on uSiguiendo.id = seg.idUsuarioSiguiendo
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
        DB::connection()->getpdo()->exec('DROP VIEW IF EXISTS vSeguir;');
    }
}
