<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VPuntuacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         //if (Schema::hasTable('vPuntuacion')) 
            DB::connection()->getpdo()->exec('DROP VIEW IF EXISTS vPuntuacion;');
        DB::connection()->getpdo()->exec("
            CREATE VIEW vPuntuacion 
            as
                SELECT idUsuario, round(avg(puntuacion)) as puntuacion FROM tbl_puntuacion
                group by idUsuario
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
        DB::connection()->getpdo()->exec('DROP VIEW IF EXISTS vPuntuacion;');
    }
}
