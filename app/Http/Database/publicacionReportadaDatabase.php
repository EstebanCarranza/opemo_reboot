<?php

namespace App\Http\Database;
use App\Http\Models\PublicacionReportada;
use Illuminate\Support\Facades\DB;


class publicacionReportadaDatabase
{
    protected $table = 'tbl_publicacionReportada';
    protected $view = 'vPublicacionReportada';
    protected $idPublicacionReportada = "idPublicacionReportada";
    protected $created_at = "created_at";
    protected $updated_at = "updated_at";
    protected $idRazonReporte = "idRazonReporte";
    protected $idPublicacion = "idPublicacion";

    public function __constructor(){}
    public function getTable(){return $this->table;}
    public function getView(){return $this->view;}
    public function getIdPublicacionReportada(){$this->idPublicacionReportada;}
    public function getCreated_at(){$this->created_at;}
    public function getUpdated_at(){$this->updated_at;}
    public function getIdRazonReporte(){$this->idRazonReporte;}
    public function getIdPublicacion(){$this->idPublicacion;}

    public function insert(PublicacionReportada $data)
    {
        DB::table($this->table)->insert(
            array(
            $this->idRazonReporte  => $data->getidRazonReporte(),
            $this->idPublicacion        => $data->getIdPublicacion()
        ));
        
        $id = DB::getPdo()->lastInsertId();
        if($id)
            return $id;
        else 
            return -1;
        
    }
    
}
