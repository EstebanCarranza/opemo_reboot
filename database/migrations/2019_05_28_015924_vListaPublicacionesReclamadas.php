<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VListaPublicacionesReclamadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::connection()->getpdo()->exec('DROP FUNCTION IF EXISTS fnGetViews;');
        DB::connection()->getpdo()->exec("
            create function fnGetViews()
            returns text
            begin
                declare antiguedad text;
                set antiguedad = (select 
                (
                    case 
                        when (TIMESTAMPDIFF(second,fecha,now())) < 60 
                            then 'Publicado ahora' 
                        when (TIMESTAMPDIFF(minute,fecha, now())) < 60 
                            then concat('Hace ',TIMESTAMPDIFF(minute,fecha,now()),' minuto(s)')
                        when (TIMESTAMPDIFF(hour,fecha,now())) < 24
                            then concat('Hace ',TIMESTAMPDIFF(hour,fecha,now()),' hora(s)')
                        when (TIMESTAMPDIFF(day,fecha,now())) >= 1 
                            then concat('Hace ',TIMESTAMPDIFF(day,fecha,now()),' dia(s)')
                        else 'Informacion incorrecta' 
                    end
                )as data);
                return antiguedad;
            end
        ");
        //si sale error subir directamente a mysql desde workbench ahi si funciona sin problemas
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection()->getpdo()->exec('DROP VIEW IF EXISTS vListaPublicacionReclamada;');
    }
}
