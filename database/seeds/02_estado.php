<?php

use Illuminate\Database\Seeder;

class estado extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ejecutar el seed: php artisan db:seed --class=estado
        DB::table('tbl_estado')->insert(array('titulo' => 'Aguascalientes','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Baja California','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Baja California Sur','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Campeche','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Chihuahua','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Chiapas','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Coahuila','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Colima','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Durango','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Guanajuato','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Guerrero','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Hidalgo','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Jalisco','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'México','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Michoacán','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Morelos','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Nayarit','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Nuevo León','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Oaxaca','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Puebla','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Querétaro','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Quintana Roo','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'San Luis Potosí','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Sinaloa','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Sonora','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Tabasco','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Tamaulipas','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Tlaxcala','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Veracruz','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Yucatán','idPais'=>1));
        DB::table('tbl_estado')->insert(array('titulo' => 'Zacatecas','idPais'=>1));
        $this->command->info('Estados agregados correctamente');
        //ejecutar el seed: php artisan db:seed --class=estado
    }
}
