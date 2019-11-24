<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class testimonioModel extends Model
{
    protected $table = 'tbl_testimonio';
    protected $idTestimonio;
    protected $titulo;
    protected $descripcion;
    protected $mostrarTestimonio;
    protected $created_at;
    protected $updated_at;

    public function __constructor()
    {

    }
/*
    public function __constructor($data)
    {
        $this->titulo = $data->titulo;
        $this->descripcion = $data->descripcion;
    }*/

    public function getIdTestimonio()
    {
        return $this->idTestimonio;
    }
    public function getTitulo()
    {
         return $this->titulo;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    public function getMostrarTestimonio()
    {
        return $this->mostrarTestimonio;
    }
    public function getCreated_at()
    {
        return $this->created_at;
    }
    public function getUpdated_at()
    {
        return $this->updated_at;
    }
    public function setIdTestimonio($idTestimonioN)
    {
        $this->idTestimonio = $idTestimonioN;
    }
    public function setTitulo($tituloN)
    {
        $this->titulo = $tituloN;
    }
    public function setDescripcion($descripcionN)
    {
        $this->descripcion = $descripcionN;
    }
    public function setMostrarTestimonio($mostrarTestimonioN)
    {
        $this->mostrarTestimonio = $mostrarTestimonioN;
    }
    public function setCreated_at($created_atN)
    {
        $this->created_at = $created_atN;
    }
    public function setUpdated_at($updated_atN)
    {
        $this->updated_at = $updated_atN;
    }
}
