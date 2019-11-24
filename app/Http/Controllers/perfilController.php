<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Usuario;
use App\Http\Database\usuarioDatabase;
use Illuminate\Support\Facades\Storage;

class perfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_info = \Auth::user();
        $userData = new usuarioDatabase();
        $usuario = new Usuario();
        $usuario = $userData->getUsuarioForId($user_info->id);
        return view('perfil.index')->with('usuario', $usuario)
        ->with('me', true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        

        return view('pages.dashboard');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userData = new usuarioDatabase();
        $usuario = new Usuario();
        $usuario = $userData->getUsuarioForId($id);
        $seguir = new seguirController();
        
        if(!\Auth::guest())
            if($id == \Auth::user()->id )
                return view('perfil.index')->with('usuario', $usuario)->with('me', true);    
            else
                return view('perfil.index')->with('usuario', $usuario)->with('seguir',$seguir->getSeguir($id));
        else
            return view('perfil.index')->with('usuario', $usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('perfil.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //updatePathAvatar
        $user_info = \Auth::user();
        $var = new Usuario();
        $db = new usuarioDatabase();
        
        //por seguridad no se utilizará el id que viene del form sino el id propio del usuario que
        //se encuentra logueado en este momento
        $var->setIdUsuario($user_info->id);

        $pathProfile = "users/".$var->getIdUsuario()."/profile";
        //Crear el directorio
        Storage::makeDirectory($pathProfile);

        $action = $request->input('ecAction');
        
        switch($action)
        {
            case "edit-avatar":
            {
                $img_avatar = $request->file('imgAvatar');
                if($img_avatar)
                {
                    //$img_avatar->getClientOriginalName()
                    $name_file = $var->getIdUsuario()."_avatar_".substr($img_avatar->getClientOriginalName(), -5);
                    $var->setPathAvatar($pathProfile."/".$name_file);
                    Storage::putFileAs($pathProfile, $img_avatar,$name_file);
                    $db->updatePathAvatar($var);
                    return redirect('profile');  
                }
            }
            break;
            case "edit-cover":
            {
                $img_cover = $request->file('imgCover');
                if($img_cover)
                {
                    $name_file = $var->getIdUsuario()."_cover_".substr($img_cover->getClientOriginalName(), -5);
                    $var->setPathPortada($pathProfile."/".$name_file);
                    Storage::putFileAs($pathProfile, $img_cover,$name_file);
                    $db->updatePathPortada($var);
                    return redirect('profile');  
                }
            }
            break;
            case "edit-info":
            {
                $var->setBio($request->input('bio'));
                $var->setAlias($request->input('alias'));
                $var->setNombre($request->input('nombre'));
                $var->setApellidoPaterno($request->input('apellidoPaterno'));
                $var->setCorreo($request->input('correo'));
                $var->setFechaNacimiento($request->input('fechaNacimiento'));
                $db->updateInfo($var);
                return redirect('profile'); 
            }
            break;
            case "edit-password":
            {

                $password = $request->input('password');
                $db->updatePassword(bcrypt($password), $user_info->id);
                return redirect('profile'); 
            }
            break;
            default:break;
        }
      //        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
