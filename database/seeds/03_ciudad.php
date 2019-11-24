<?php

use Illuminate\Database\Seeder;

class ciudad extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {           
        //ejecutar el seed: php artisan db:seed --class=ciudad
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Abasolo ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Agualeguas ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Allende','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Anáhuac','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Apodaca','idEstado'=>18, 'areaMetropolitana' => true));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Aramberri','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Bustamante ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Cadereyta Jiménez','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Cerralvo','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'China','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Ciénega de Flores','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Doctor Arroyo','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Doctor Coss ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Doctor González ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'El Carmen','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Galeana','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'García','idEstado'=>18, 'areaMetropolitana' => true));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'General Bravo','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'General Escobedo','idEstado'=>18, 'areaMetropolitana' => true));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'General Terán','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'General Treviño ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'General Zaragoza','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'General Zuazua','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Guadalupe','idEstado'=>18, 'areaMetropolitana' => true));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Hidalgo','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Higueras ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Hualahuises','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Iturbide ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Juárez','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Lampazos de Naranjo','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Linares','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Los Aldamas ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Los Herreras ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Los Ramones','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Marín','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Melchor Ocampo ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Mier y Noriega','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Mina','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Montemorelos','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Monterrey','idEstado'=>18, 'areaMetropolitana' => true));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Parás ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Pesquería','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Rayones ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Sabinas Hidalgo','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Salinas Victoria','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'San Nicolás de los Garza','idEstado'=>18, 'areaMetropolitana' => true));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'San Pedro Garza García','idEstado'=>18, 'areaMetropolitana' => true));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Santa Catarina','idEstado'=>18, 'areaMetropolitana' => true));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Santiago','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Vallecillo ','idEstado'=>18));
        DB::table('tbl_ciudad')->insert(array('titulo'=>'Villaldama','idEstado'=>18));

        $this->command->info('Ciudades agregadas correctamente');
        //ejecutar el seed: php artisan db:seed --class=ciudad
    }
}
