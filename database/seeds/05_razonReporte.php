<?php

use Illuminate\Database\Seeder;

class razonReporte extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ejecutar el seed: php artisan db:seed --class=razonReporte
        DB::table('tbl_razonReporte')->insert(array('titulo' => 'Información falsa'));
        DB::table('tbl_razonReporte')->insert(array('titulo' => 'Es ofensivo'));
        DB::table('tbl_razonReporte')->insert(array('titulo' => 'Tiene contenido inapropiado'));
        DB::table('tbl_razonReporte')->insert(array('titulo' => 'La ubicación no existe'));
        DB::table('tbl_razonReporte')->insert(array('titulo' => 'Muy poca información'));
        DB::table('tbl_razonReporte')->insert(array('titulo' => 'Spam'));
        DB::table('tbl_razonReporte')->insert(array('titulo' => 'No se encuentra en el área metropolitana'));
        
        
        $this->command->info('Razone de reporte agregadas correctamente');
    }
}
