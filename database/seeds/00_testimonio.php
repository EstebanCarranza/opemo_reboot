<?php

use Illuminate\Database\Seeder;

class testimonio extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ejecutar el seed: php artisan db:seed --class=testimonio
        //si no aparece actualiar composer => composer update
        DB::table('tbl_testimonio')->insert(array(
            'titulo'=>'Muy bueno',
            'descripcion'=>'Gracias a OPEMO y a un joven caritativo pude recuperar mi cartera con las tarjetas de crédito intactas',
            'mostrarTestimonio'=>true
        ));
        DB::table('tbl_testimonio')->insert(array(
            'titulo'=>'Lo recomiendo',
            'descripcion'=>'Gracias a OPEMO y a un joven caritativo pude recuperar mi cartera con las tarjetas de crédito intactas',
            'mostrarTestimonio'=>true
        ));
        DB::table('tbl_testimonio')->insert(array(
            'titulo'=>'Muchas gracias',
            'descripcion'=>'Gracias a OPEMO y a un joven caritativo pude recuperar mi cartera con las tarjetas de crédito intactas',
            'mostrarTestimonio'=>true
        ));
        DB::table('tbl_testimonio')->insert(array(
            'titulo'=>'De lo mejor',
            'descripcion'=>'Gracias a OPEMO y a un joven caritativo pude recuperar mi cartera con las tarjetas de crédito intactas',
            'mostrarTestimonio'=>true
        ));
        DB::table('tbl_testimonio')->insert(array(
            'titulo'=>'Gracias',
            'descripcion'=>'Gracias a OPEMO y a un joven caritativo pude recuperar mi cartera con las tarjetas de crédito intactas',
            'mostrarTestimonio'=>true
        ));
        DB::table('tbl_testimonio')->insert(array(
            'titulo'=>'Increíble',
            'descripcion'=>'Gracias a OPEMO y a un joven caritativo pude recuperar mi cartera con las tarjetas de crédito intactas',
            'mostrarTestimonio'=>true
        ));
        

        $this->command->info('Testimonios agregados correctamente');
    }
}
