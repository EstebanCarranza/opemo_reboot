<?php

namespace App\Http\Controllers;
use Illuminate\Http\File;
//use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Publicacion;
use App\Http\StaticData\tbl_publicacion;
use App\Http\Models\Ubicacion;
use App\Http\Database\ubicacionDatabase;
use App\Http\Database\usuarioDatabase;

class helperImageController extends Controller
{
    
    public function __constructor()
    {

    }
    public function index()
    {

    }
    
    public function getPublicationPhoto(Request $request)
    {
        //Si no manda ID solamente retornará la leyenda que este en el "else"
        if($request->id)
        {
            $id = $request->id;
            $data = new publicacion();
            $publicacion = DB::table($data->getTableName())->select(tbl_publicacion::getPath())->where(tbl_publicacion::getId(), $id)->first();
            if($publicacion)
            {
                $data->setPathImgVideo($publicacion->pathImgVideo);
                /*if (!file_exists($data->getPathImgVideo())) {
                    return 'No hay imagen';
                }else
                {*/
                
                    $response = response()->make(Storage::get($data->getPathImgVideo()), 200);
                    if(substr($data->getPathImgVideo(),-3) == "mp4"){
                        $response->header("Content-Type", 'video/mp4');
                    }
                    else
                        $response->header("Content-Type", 'image/png');
                    return $response;
                //}
                
                
            }
            else {return "Publicacion no encontrada";}
        }else {
            return "Los datos ingresados no son correctos";
        }
        
    }
     public function getUbicationPhoto(Request $request)
    {
        $dbUbicacion = new ubicacionDatabase();
        //Si no manda ID solamente retornará la leyenda que este en el "else"
        if($request->id)
        {
            $id = $request->id;
            $data = new Ubicacion();
            $ubiData = DB::table($data->getTableName())->select($dbUbicacion->getPathUbicacion())
            ->where($dbUbicacion->getIdUbicacion(), $id)->first();
            if($ubiData)
            {
                $data->setPathUbicacion($ubiData->pathUbicacion);
                $response = response()->make(Storage::get($data->getPathUbicacion()), 200);
                $response->header("Content-Type", 'image/png');
                return $response;
            }
            else {return "Imagen no encontrada";}
        }else {
            return "Los datos ingresados no son correctos";
        }
    }
     public function getProfileAvatarPhoto(Request $request)
    {
        $dbUsuario = new usuarioDatabase();
        //Si no manda ID solamente retornará la leyenda que este en el "else"
        if($request->id)
        {
            $id = $request->id;
            $userData = DB::table($dbUsuario->getTable())->select($dbUsuario->getPathAvatar())
            ->where($dbUsuario->getIdUsuario(), $id)->first();
            if($userData)
            {
                if($request->path)
                {
                    return $userData->getPathAvatar();
                }
                else {
                    $response = response()->make(Storage::get($userData->pathAvatar), 200);
                    $response->header("Content-Type", 'image/png');
                    return $response;    
                }
                
            }
            else {return "Imagen no encontrada";}
        }else {
            return "Los datos ingresados no son correctos";
        }
        
    }
    public function getProfileCoverPhoto(Request $request)
    {
        $dbUsuario = new usuarioDatabase();
        //Si no manda ID solamente retornará la leyenda que este en el "else"
        if($request->id)
        {
            $id = $request->id;
            $userData = DB::table($dbUsuario->getTable())->select($dbUsuario->getPathPortada())
            ->where($dbUsuario->getIdUsuario(), $id)->first();
            if($userData)
            {
                $response = response()->make(Storage::get($userData->pathPortada), 200);
                $response->header("Content-Type", 'image/png');
                return $response;
            }
            else {return "Imagen no encontrada";}
        }else {
            return "Los datos ingresados no son correctos";
        }
        
    }
    
}
