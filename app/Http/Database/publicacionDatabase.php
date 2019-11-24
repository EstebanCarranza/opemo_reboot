<?php

namespace App\Http\Database;
use App\Http\Models\Publicacion;
use Illuminate\Support\Facades\DB;


class publicacionDatabase
{
    protected $table = 'tbl_publicacion';
    protected $view = 'vListaPublicacion';
    protected $idPublicacion = "idPublicacion";
    protected $titulo = "titulo";
    protected $pathVistaPrevia = "pathVistaPrevia";
    protected $pathImgVideo = "pathImgVideo";
    protected $fecha = "fecha";
    protected $hora = "hora";
    protected $descripcion = "descripcion";
    protected $created_at = "created_at";
    protected $updated_at = "updated_at";
    protected $idUbicacion = "idUbicacion";
    protected $idPublicacionEstado = "idPublicacionEstado";
    protected $idUsuario = "idUsuario";

    protected $vNombreUsuario = "nombreUsuario";
    protected $vTituloUbicacion = "tituloUbicacion";
    protected $vTituloPublicacionEstado = "tituloPublicacionEstado";
    protected $vTituloCiudad = "tituloCiudad"; 
    protected $vTituloCiudadCompleta = "tituloCiudadCompleta";
    
    //para el resultado de la funcion antiguedad
    protected $antiguedad = "antiguedad";

    public function getIdPublicacion(){ return $this->idPublicacion;}
    public function getTitulo(){return $this->titulo;}
    public function getPathImgVideo(){return $this->pathImgVideo;}
    public function getFecha(){return $this->fecha;}
    public function getHora(){return $this->hora;}
    public function getDescripcion(){return $this->descripcion;}
    public function getCreated_at(){return $this->created_at;}
    public function getUpdated_at(){return $this->update_at;}
    public function getIdUbicacion(){return $this->idUbicacion;}
    public function getIdPublicacionEstado(){return $this->idPublicacionEstado;}
    public function getIdUsuario(){return $this->idUsuario;}
    
    //get data for view vListaPublicacion
    public function getTituloUbicacion(){return $this->vTituloUbicacion;}
    public function getTituloPublicacionEstado(){return $this->vTituloPublicacionEstado;}
    public function getTituloCiudad(){return $this->vTituloCiudad;}
    public function getTituloCiudadCompleta(){return $this->vTituloCiudadCompleta;}
    public function getNombreUsuario(){return $this->vNombreUsuario;}

    //get data for function antiguedad
    public function getAntiguedad(){return $this->antiguedad;}
    
    public function setIdPublicacion($idPublicacionN){$this->idPublicacion = $idPublicacionN;}
    public function setTitulo($tituloN){$this->titulo = $tituloN;}
    public function setPathImgVideo($pathImgVideoN){$this->pathImgVideo = $pathImgVideoN;}
    public function setFecha($fechaN){$this->fecha = $fechaN;}
    public function setHora($horaN){$this->hora = $horaN;}
    public function setDescripcion($descripcionN){$this->descripcion = $descripcionN;}
    public function setCreated_at($created_atN){$this->created_at = $created_atN;}
    public function setUpdated_at($updated_atN){$this->updated_at = $updated_atN;}
    public function setIdUbicacion($idUbicacionN){$this->idUbicacion = $idUbicacionN;}
    public function setIdPublicacionEstado($idPublicacionEstadoN){$this->idPublicacionEstado = $idPublicacionEstadoN;}
    public function setIdUsuario($idUsuarioN){$this->idUsuario = $idUsuarioN;}

    //set data for view vListaPublicacion (not insert in database)
    public function setTituloUbicacion($vTituloUbicacionN){$this->vTituloUbicacion = $vTituloUbicacionN;}
    public function setTituloPublicacionEstado($vTituloPublicacionEstadoN){ $this->vTituloPublicacionEstado = $vTituloPublicacionEstadoN;}
    public function setTituloCiudad($vTituloCiudadN){ $this->vTituloCiudad = $vTituloCiudadN;}
    public function setTituloCiudadCompleta($vTituloCiudadCompletaN){ $this->vTituloCiudadCompleta = $vTituloCiudadCompletaN;}
    public function setNombreUsuario($vNombreUsuarioN){ $this->vNombreUsuario = $vNombreUsuarioN;}
    //set data for function antiguedad
    public function setAntiguedad($antiguedadN){$this->antiguedad = $antiguedadN;}

    public function insert(Publicacion $publicacionN)
    {
         DB::table($this->table)->insert(array(
            $this->titulo        =>          $publicacionN->getTitulo(),
            $this->fecha         =>          $publicacionN->getFecha(),
            $this->hora          =>          $publicacionN->getHora(),
            $this->idUbicacion   =>          $publicacionN->getIdUbicacion(),
            $this->idPublicacionEstado =>    $publicacionN->getIdPublicacionEstado(),
            $this->pathVistaPrevia =>        $publicacionN->getPathImgVideo(),
            $this->descripcion   =>          $publicacionN->getDescripcion(),
            $this->pathImgVideo   =>         $publicacionN->getPathImgVideo(),
            $this->idUsuario      =>         $publicacionN->getIdUsuario()
        ));
        return true;
    }
    public function updateOnlyInfo(Publicacion $publicacionN)
    {
        DB::table($this->table)
            ->where($this->getIdPublicacion(), $publicacionN->getIdPublicacion())
            ->update([
                $this->titulo        =>          $publicacionN->getTitulo(),
                $this->fecha         =>          $publicacionN->getFecha(),
                $this->hora          =>          $publicacionN->getHora(),
                $this->idUbicacion   =>          $publicacionN->getIdUbicacion(),
                $this->idPublicacionEstado =>    $publicacionN->getIdPublicacionEstado(),
                $this->descripcion   =>          $publicacionN->getDescripcion(),
                $this->updated_at  => null
            ]);
        return true;
    }
    public function updateAllData(Publicacion $publicacionN)
    {
        DB::table($this->table)
            ->where($this->getIdPublicacion(), $publicacionN->getIdPublicacion())
            ->update([
                $this->titulo        =>          $publicacionN->getTitulo(),
                $this->fecha         =>          $publicacionN->getFecha(),
                $this->hora          =>          $publicacionN->getHora(),
                $this->idUbicacion   =>          $publicacionN->getIdUbicacion(),
                $this->idPublicacionEstado =>    $publicacionN->getIdPublicacionEstado(),
                $this->pathVistaPrevia =>        $publicacionN->getPathImgVideo(),
                $this->descripcion   =>          $publicacionN->getDescripcion(),
                $this->pathImgVideo   =>         $publicacionN->getPathImgVideo(),
                $this->updated_at  => null
            ]);
        return true;
    }

}