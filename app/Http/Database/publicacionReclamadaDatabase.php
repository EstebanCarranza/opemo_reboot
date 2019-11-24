<?php

namespace App\Http\Database;
use App\Http\Models\PublicacionReclamada;
use Illuminate\Support\Facades\DB;


class publicacionReclamadaDatabase
{
    protected $table = 'tbl_publicacionReclamada';
    protected $view = '';
    protected $idPublicacionReclamada = "idPublicacionReclamada";
    protected $created_at = "created_at";
    protected $updated_at = "updated_at";
    protected $idUsuarioReclamador = "idUsuarioReclamador";
    protected $idPublicacion = "idPublicacion";
    protected $descripcion = "descripcion";

    public function __constructor(){}
    public function getTable(){return $this->table;}
    public function getIdPublicacionReclamada(){$this->publicacionReclamada;}
    public function getCreated_at(){$this->created_at;}
    public function getUpdated_at(){$this->updated_at;}
    public function getIdUsuarioReclamador(){$this->idUsuarioReclamador;}
    public function getIdPublicacion(){$this->idPublicacion;}
    public function getDescripcion(){$this->descripcion;}


    public function insert(PublicacionReclamada $data)
    {
        DB::table($this->table)->insert(
            array(
            $this->idUsuarioReclamador  => $data->getIdUsuarioReclamador(),
            $this->idPublicacion        => $data->getIdPublicacion(),
            $this->descripcion          => $data->getDescripcion()
        ));
        
        $id = DB::getPdo()->lastInsertId();

        DB::table('tbl_publicacion')
            ->where('idPublicacion',$data->getIdPublicacion())
                ->update(['idPublicacionEstado'=>7]);
        
        DB::table('tbl_mensajes')->insert(
            array(
            'idPublicacionReclamada'    => $id,
            'idUsuario2'                => \Auth::user()->id,
            'idUsuario1'                => $data->getIdUsuarioReclamador(),
            'mensaje'                   => $data->getDescripcion()
        ));
        
        if($id)
            return $id;
        else 
            return -1;
        
    }
    
    
}
