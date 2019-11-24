<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'users';
    protected $idUsuario;
    protected $alias;
    protected $correo;
    protected $contrasenia;
    protected $tokenRecuperacion;
    protected $nombre;
    protected $apellidoPaterno;
    protected $pathAvatar;
    protected $pathPortada;
    protected $bio;
    protected $fechaNacimiento;
    protected $bloqueado;
    protected $created_at ;
    protected $updated_at ;

    public function __construct()
    {
        
    }

    public function getTable(){return $this->table;}
    public function getIdUsuario(){return $this->idUsuario;}
    public function getAlias(){return $this->alias;}
    public function getCorreo(){return $this->correo;}
    public function getContrasenia(){return $this->contrasenia;}
    public function getTokenRecuperacion(){return $this->tokenRecuperacion;}
    public function getNombre(){return $this->nombre;}
    public function getApellidoPaterno(){return $this->apellidoPaterno;}
    public function getPathAvatar(){return $this->pathAvatar;}
    public function getPathPortada(){return $this->pathPortada;}
    public function getBio(){return $this->bio;}
    public function getFechaNacimiento(){return $this->fechaNacimiento;}
    public function getBloqueado(){return $this->bloqueado;}
    public function getCreated_at(){return $this->created_at;}
    public function getUpdated_at(){return $this->updated_at;}

    public function setIdUsuario($idUsuarioN){$this->idUsuario = $idUsuarioN ;}
    public function setAlias($aliasN){$this->alias = $aliasN ;}
    public function setCorreo($correoN){$this->correo = $correoN ;}
    public function setContrasenia($contraseniaN){$this->contrasenia = $contraseniaN ;}
    public function setTokenRecuperacion($tokenRecuperacionN){$this->tokenRecuperacion = $tokenRecuperacionN ;}
    public function setNombre($nobmreN){$this->nombre = $nobmreN ;}
    public function setApellidoPaterno($apellidoPaternoN){$this->apellidoPaterno = $apellidoPaternoN ;}
    public function setPathAvatar($pathAvatarN){$this->pathAvatar = $pathAvatarN ;}
    public function setPathPortada($pathPortadaN){$this->pathPortada = $pathPortadaN ;}
    public function setBio($bioN){$this->bio = $bioN ;}
    public function setFechaNacimiento($fechaNacimientoN){$this->fechaNacimiento = $fechaNacimientoN ;}
    public function setBloqueado($bloqueadoN){$this->bloqueado = $bloqueadoN ;}
    public function setCreated_at($created_atN){$this->created_at = $created_atN ;}
    public function setUpdated_at($updated_atN){$this->updated_at = $updated_atN ;}
}
