<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VComentario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //if (Schema::hasTable('vComentario')) 
            DB::connection()->getpdo()->exec('DROP VIEW IF EXISTS vComentario;');
            DB::connection()->getpdo()->exec("
                create view vComentario
                as 
                SELECT 
                com.idComentario, 
                com.created_at, 
                com.updated_at, 
                com.idUsuario, 
                us.name,
                com.idPublicacion, 
                com.comentario,
                fnObtenerAntiguedad(com.created_at) as antiguedad,
                concat('/image/profile/avatar?id=', com.idUsuario) as pathImagen
                FROM tbl_comentario as com
                inner join users as us on us.id = com.idUsuario
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
         DB::connection()->getpdo()->exec('DROP VIEW IF EXISTS vComentario;');
    }
}
