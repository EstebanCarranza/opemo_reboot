<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PublicacionReclamada extends Model
{
    protected $table = "tbl_publicacionReclamada";
    protected $view = '';
    protected $idPublicacionReclamada;
    protected $created_at;
    protected $updated_at;
    protected $idUsuarioReclamador;
    protected $idPublicacion;
    protected $descripcion;

    public function __constructor(){}
    public function getTable(){return $this->table;}
    public function getIdPublicacionReclamada(){return $this->publicacionReclamada;}
    public function getCreated_at(){return $this->created_at;}
    public function getUpdated_at(){return $this->updated_at;}
    public function getIdUsuarioReclamador(){return $this->idUsuarioReclamador;}
    public function getIdPublicacion(){return $this->idPublicacion;}
    public function getDescripcion(){return $this->descripcion;}

    public function setIdPublicacionReclamada($idPublicacionReclamadaN){$this->publicacionReclamada = $idPublicacionReclamadaN;}
    public function setCreated_at($created_atN){$this->created_at = $created_atN;}
    public function setUpdated_at($updated_atN){$this->updated_at;}
    public function setIdUsuarioReclamador($idUsuarioReclamadorN){$this->idUsuarioReclamador = $idUsuarioReclamadorN;}
    public function setIdPublicacion($idPublicacionN){$this->idPublicacion = $idPublicacionN;}
    public function setDescripcion($descripcionN){$this->descripcion = $descripcionN;}
}
