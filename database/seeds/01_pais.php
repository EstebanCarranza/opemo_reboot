<?php

use Illuminate\Database\Seeder;

class pais extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ejecutar el seed: php artisan db:seed --class=pais
        DB::table('tbl_pais')->insert(array('idPais' => 1, 'titulo' => 'México'));
        $this->command->info('Paises agregados correctamente');
        //ejecutar el seed: php artisan db:seed --class=pais
    }
}
