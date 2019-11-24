<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class RazonReporte extends Model
{
    protected $table = 'tbl_razonReporte';
    
    protected $idRazonReporte;
    protected $titulo;
    protected $created_at;
    protected $updated_at;

    public function getIdRazonReporte(){return $this->idRazonReporte;}
    public function getTitulo(){return $this->titulo;}
    public function getCreated_at(){return $this->created_at;}
    public function getUpdated_at(){return $this->updated_at;}

    public function setIdRazonReporte($idRazonReporteN){$this->idRazonReporte = $idRazonReporteN;}
    public function setTitulo($tituloN){$this->titulo = $N;}
    public function setCreated_at($created_atN){$this->created_at = $created_atN;}
    public function setUpdated_at($updated_atN){$this->updated_at = $updated_atN;}
}
