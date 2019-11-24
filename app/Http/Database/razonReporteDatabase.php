<?php

namespace App\Http\Database;
use App\Http\Models\razonReporte;
use Illuminate\Support\Facades\DB;


class razonReporteDatabase
{
    protected $table = 'tbl_razonReporte';
    
    protected $idRazonReporte = "idRazonReporte";
    protected $titulo = "titulo";
    protected $created_at = "created_at";
    protected $updated_at = "updated_at";

    public function getTable(){return $this->table;}
    public function __constructor(){}
    public function getIdRazonReporte(){return $this->idRazonReporte;}
    public function getTitulo(){return $this->titulo;}
    public function getCreated_at(){return $this->created_at;}
    public function getUpdated_at(){return $this->updated_at;}

    public function getList()
    {
        return DB::table($this->table)
            ->select(
                $this->idRazonReporte,
                $this->titulo
            )
            ->get();
    }
    public function reportarPublicacion($idRazonReporte, $idPublicacion)
    {
       
        DB::table('tbl_publicacionReportada')->insert(
            array
            (
                'idRazonReporte' => $idRazonReporte,
                'idPublicacion' => $idPublicacion
            )
        ); 
        return true;
    }
/*
    public function setIdRazonReporte($idRazonReporteN){$this->idRazonReporte = $idRazonReporteN;}
    public function setTitulo($tituloN){$this->titulo = $N;}
    public function setCreated_at($created_atN){$this->created_at = $created_atN;}
    public function setUpdated_at($updated_atN){$this->updated_at = $updated_atN;}*/
}