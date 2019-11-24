<?php

namespace App\Http\Database;
use App\Http\Models\Comentario;
use Illuminate\Support\Facades\DB;


class comentarioDatabase
{
    protected $table = 'tbl_comentario';
    protected $view = 'vComentario';
    protected $idComentario = "idComentario";
    protected $idPublicacion = "idPublicacion";
    protected $idUsuario = "idUsuario";
    protected $created_at = "created_at";
    protected $updated_at = "updated_at";
    protected $comentario = "comentario";

    public function getTable(){return $this->table;}
    public function getView(){return $this->view;}
    public function getIdComentario(){return $this->idComentario;}
    public function getIdPublicacion(){return $this->idPublicacion;}
    public function getIdUsuario(){return $this->idUsuario;}
    public function getCreated_at(){return $this->created_at;}
    public function getUpdated_at(){return $this->updated_at;}
    public function getComentario(){return $this->comentario;}

    public function setIdComentario($idComentarioN){$this->idComentario = $idComentarioN;}
    public function setIdPublicacion($idPublicacionN){$this->idPublicacion = $idPublicacionN;}
    public function setIdUsuario($idUsuarioN){$this->idUsuario = $idUsuarioN;}
    public function setCreated_at($created_atN){$this->created_at = $created_atN;}
    public function setUpdated_at($updated_atN){$this->updated_at = $updated_atN;}
    public function setComentario($comentarioN){$this->comentario = $comentarioN;}

    public function insert(Comentario $data)
    {
        DB::table($this->table)->insert(array(
            $this->idPublicacion => $data->getIdPublicacion(),
            $this->idUsuario => $data->getIdUsuario(),
            $this->comentario => $data->getComentario()
        ));
        return true;
    }
    public function getCommentList($idPublicacion)
    {
        
        $dbList = DB::table($this->table)->select()
        ->where($this->idPublicacion, $idPublicacion)
        ->get();
        $comentList = array();
        foreach($dbList as $dbc)
        {
            $comentario = new Comentario();
            $comentario->setIdPublicacion($dbc->idPublicacion);
            $comentario->setIdComentario($dbc->idComentario);
            $comentario->setIdUsuario($dbc->idUsuario);
            $comentario->setComentario($dbc->comentario);
            array_push($comentList, $comentario);
        }
        return $comentList;
    }

}
