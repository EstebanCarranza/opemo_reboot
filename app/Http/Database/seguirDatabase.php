<?php

namespace App\Http\Database;
use App\Http\Models\Seguir;
use Illuminate\Support\Facades\DB;


class seguirDatabase
{
    protected $table = "tbl_seguir";
    protected $idSeguir = "idSeguir";
    protected $idUsuarioSiguiendo = "idUsuarioSiguiendo";
    protected $idUsuarioSeguidor = "idUsuarioSeguidor";
    protected $created_at = "created_at";
    protected $updated_at = "updated_at";

    public function getTable(){return $this->table;}
    public function getIdSeguir(){return $this->idSeguir;}
    public function getIdUsuarioSiguiendo(){return $this->idUsuarioSiguiendo;}
    public function getIdUsuarioSeguidor(){return $this->idUsuarioSeguidor;}
    public function getCreated_at(){return $this->created_at;}
    public function getUpdated_at(){return $this->updated_at;}

    public function setIdSeguir($idSeguirN){$this->idSeguir = $idSeguirN;}
    public function setIdUsuarioSiguiendo($idUsuarioSiguiendoN){$this->idUsuarioSiguiendo = $idUsuarioSiguiendoN;}
    public function setIdUsuarioSeguidor($idUsuarioSeguidorN){$this->idUsuarioSeguidor = $idUsuarioSeguidorN;}
    public function setCreated_at($created_atN){$this->created_at = $created_atN;}
    public function setUpdated_at($updated_atN){$this->updated_at = $updated_atN;}
}