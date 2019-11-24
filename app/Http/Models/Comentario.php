<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'tbl_comentario';

    protected $idComentario;
    protected $idPublicacion;
    protected $idUsuario;
    protected $created_at;
    protected $updated_at;
    protected $comentario;

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

    public function comments()
    {
        return $this->belongsTo(Publicacion::class);
    }

}
