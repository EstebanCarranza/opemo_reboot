<?php

namespace App\Http\Database;
use App\Http\Models\Ubicacion;
use Illuminate\Support\Facades\DB;


class ubicacionDatabase
{
    protected $table = "tbl_ubicacion";

    protected $idUbicacion = "idUbicacion";
    protected $titulo = "titulo";
    protected $descripcion = "descripcion";
    protected $created_at = "created_at";
    protected $updated_at = "updated_at";
    protected $idCiudad = "idCiudad";
    protected $idUsuario = "idUsuario";
    protected $pathUbicacion = "pathUbicacion";

    public function __construct()
    {

    }
    public function getIdUbicacion(){return $this->idUbicacion;}
    public function getTitulo(){return $this->titulo;}
    public function getDescripcion(){return $this->decripcion;}
    public function getCreated_at (){return $this->created_at;}
    public function getUpdated_at(){return $this->updated_at;}
    public function getIdCiudad(){return $this->idCiudad;}
    public function getIdUsuario(){return $this->idUsuario;}
    public function getPathUbicacion(){return $this->pathUbicacion;}
    public function insert(Ubicacion $data)
    { 

        DB::table($this->table)->insert(array(
            $this->titulo => $data->getTitulo(),
            $this->descripcion => $data->getDescripcion(),
            $this->idCiudad  => $data->getIdCiudad(),
            $this->idUsuario => $data->getIdUsuario(),
            $this->pathUbicacion => $data->getPathUbicacion()
        ));
        return true;
    }
    public function updateOnlyInfo(Ubicacion $data)
    {
        DB::table($this->table)
            ->where($this->idUbicacion, $data->getIdUbicacion())
            ->update([
                $this->titulo => $data->getTitulo(),
                $this->descripcion => $data->getDescripcion(),
                $this->idCiudad  => $data->getIdCiudad(),
                $this->updated_at  => null
        ]);
        return true;
    }
    public function updateAllData(Ubicacion $data)
    { 
        DB::table($this->table)
            ->where($this->idUbicacion, $data->getIdUbicacion())
            ->update([
                $this->titulo => $data->getTitulo(),
                $this->descripcion => $data->getDescripcion(),
                $this->idCiudad  => $data->getIdCiudad(),
                $this->pathUbicacion => $data->getPathUbicacion(),
                $this->updated_at  => null
            ]);
        return true;
    }
    public function getUbicationForId($id)
    {
        $data = new Ubicacion();
        $db = DB::table($data->getViewShow())->select()
            ->where($this->getIdUbicacion(), $id)->first();

        $data->setIdUbicacion($db->idUbicacion);
        $data->setTitulo($db->titulo);
        $data->setDescripcion($db->descripcion);
        $data->setPathUbicacion($db->pathUbicacion);
        $data->setIdCiudad($db->idCiudad);
        $data->setCreated_at($db->created_at);
        $data->setUpdated_at($db->updated_at);
        $data->setIdUsuario($db->idUsuario);
        //exclusivo de la vista
        $data->setTituloCiudad($db->tituloCiudad);
        $data->setTituloCiudadCompleta($db->tituloCiudadCompleta);
        $data->setAlias($db->name);
        $data->setPathAvatar($db->pathAvatar);
        $data->setAntiguedad($db->antiguedad);
        return $data;
    }
    public function getUbicationList()
    {
        $data = new Ubicacion();
        $ubicaciones = DB::table($data->getViewShow())->select()->orderBy('updated_at','desc')->get();
        $ubicacionList = array();
        
        foreach($ubicaciones as $ubicacion)
        {
            $data = new Ubicacion();
            $data->setIdUbicacion($ubicacion->idUbicacion);
            $data->setTitulo($ubicacion->titulo);
            $data->setDescripcion($ubicacion->descripcion);
            $data->setPathUbicacion($ubicacion->pathUbicacion);
            $data->setIdCiudad($ubicacion->idCiudad);
            $data->setCreated_at($ubicacion->created_at);
            $data->setUpdated_at($ubicacion->updated_at);
            //exclusivo de la vista
            $data->setTituloCiudad($ubicacion->tituloCiudad);
            $data->setTituloCiudadCompleta($ubicacion->tituloCiudadCompleta);
            $data->setAlias($ubicacion->name);
            $data->setPathAvatar($ubicacion->pathAvatar);
            $data->setAntiguedad($ubicacion->antiguedad);
            array_push($ubicacionList, $data);
           
        }
        return $ubicacionList;
    }
     public function getMyUbicationList($id)
    {
        $data = new Ubicacion();
        $ubicaciones = DB::table($data->getViewShow())->select()
        ->where($this->getIdUsuario(), $id)
        ->orderBy('updated_at','desc')->get();
        $ubicacionList = array();
        
        foreach($ubicaciones as $ubicacion)
        {
            $data = new Ubicacion();
            $data->setIdUbicacion($ubicacion->idUbicacion);
            $data->setTitulo($ubicacion->titulo);
            $data->setDescripcion($ubicacion->descripcion);
            $data->setPathUbicacion($ubicacion->pathUbicacion);
            $data->setIdCiudad($ubicacion->idCiudad);
            $data->setCreated_at($ubicacion->created_at);
            $data->setUpdated_at($ubicacion->updated_at);
            //exclusivo de la vista
            $data->setTituloCiudad($ubicacion->tituloCiudad);
            $data->setTituloCiudadCompleta($ubicacion->tituloCiudadCompleta);
            $data->setAlias($ubicacion->name);
            $data->setPathAvatar($ubicacion->pathAvatar);
            $data->setAntiguedad($ubicacion->antiguedad);
            array_push($ubicacionList, $data);
           
        }
        return $ubicacionList;
    }
}
