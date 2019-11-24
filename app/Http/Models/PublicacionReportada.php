<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PublicacionReportada extends Model
{
    protected $table = 'tbl_publicacionReportada';
    protected $view = '';
    protected $idPublicacionReportada;
    protected $created_at;
    protected $updated_at;
    protected $idPublicacion;
    protected $idRazonReporte;

    public function getIdPublicacionReportada(){return $this->idPublicacionReportada;}
    public function getCreated_at(){return $this->created_at;}
    public function getUpdated_at(){return $this->updated_at;}
    public function getIdPublicacion(){return $this->idPublicacion;}
    public function getIdRazonReporte(){return $this->idRazonReporte;}

    public function setIdPublicacionReportada($idPublicacionReportadaN){$this->idPublicacionReportada = $idPublicacionReportadaN;}
    public function setCreated_at($created_atN){$this->created_at = $created_atN;}
    public function setUpdated_at($updated_atN){$this->updated_at = $updated_atN;}
    public function setIdPublicacion($idPublicacionN){$this->idPublicacion = $idPublicacionN;}
    public function setIdRazonReporte($idRazonReporteN){$this->idRazonReporte = $idRazonReporteN;}
}
