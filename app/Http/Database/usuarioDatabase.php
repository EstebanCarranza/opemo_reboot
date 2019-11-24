<?php

namespace App\Http\Database;
use App\Http\Models\Usuario;
use Illuminate\Support\Facades\DB;


class usuarioDatabase
{
    protected $table = "users";
    protected $idUsuario = "id";
    protected $alias = "name";
    protected $correo = "email";
    protected $contrasenia = "password";
    protected $tokenRecuperacion = "remember_token";
    protected $nombre = "nombre";
    protected $apellidoPaterno = "apellido_pat";
    protected $pathAvatar = "pathAvatar";
    protected $pathPortada = "pathPortada";
    protected $bio = "bio";
    protected $fechaNacimiento = "fechaNacimiento";
    protected $bloqueado = "bloqueado";
    protected $created_at = "created_at";
    protected $updated_at = "updated_at";
    
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

    public function getUsuarioForId($id)
    {
        $userData = new Usuario();
        $dbUser = DB::table($userData->getTable())->select(
            $this->idUsuario,
            $this->alias, $this->correo, $this->pathAvatar, $this->pathPortada, $this->bio,
            $this->fechaNacimiento, $this->bloqueado, $this->nombre, $this->apellidoPaterno
        )->where($this->idUsuario, $id)->first();
        
        $userData->setIdUsuario($dbUser->id);
        $userData->setAlias($dbUser->name);
        $userData->setNombre($dbUser->nombre);
        $userData->setApellidoPaterno($dbUser->apellido_pat);
        $userData->setCorreo($dbUser->email);
        $userData->setPathAvatar($dbUser->pathAvatar);
        $userData->setPathPortada($dbUser->pathPortada);
        $userData->setBio($dbUser->bio);
        $userData->setFechaNacimiento($dbUser->fechaNacimiento);
        $userData->setBloqueado($dbUser->bloqueado);

        return $userData;
    }
    public function updatePassword($passwordN, $idN)
    {
        $user = new Usuario();
        DB::table($user->getTable())
            ->where($this->idUsuario, $idN)
            ->update([$this->contrasenia => $passwordN]);
        return true;
    }
    public function updatePathAvatar(Usuario $user)
    {
        //echo $user->getIdUsuario()."-".$user->getPathAvatar();
        DB::table($user->getTable())
            ->where($this->idUsuario, $user->getIdUsuario())
            ->update([$this->pathAvatar => $user->getPathAvatar()]);
        return true;
    }
    public function updatePathPortada(Usuario $user)
    {
        //echo $user->getIdUsuario()."-".$user->getPathAvatar();
        DB::table($user->getTable())
            ->where($this->idUsuario, $user->getIdUsuario())
            ->update([$this->pathPortada => $user->getPathPortada()]);
        return true;
    }
    public function updateInfo(Usuario $user)
    {
         DB::table($user->getTable())
            ->where($this->idUsuario, $user->getIdUsuario())
            ->update([
                $this->alias => $user->getAlias(),
                $this->correo => $user->getCorreo(),
                $this->nombre => $user->getNombre(),
                $this->apellidoPaterno => $user->getApellidoPaterno(),
                $this->bio => $user->getBio(),
                $this->fechaNacimiento => $user->getFechaNacimiento()
            ]);
        return true;
    }
}
