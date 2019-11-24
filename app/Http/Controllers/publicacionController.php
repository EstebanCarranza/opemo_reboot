<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Models\Publicacion;
use Illuminate\Http\File;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Comentario;
use App\Http\Database\comentarioDatabase;
use App\Http\Database\publicacionDatabase;

class publicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $table = "tbl_publicacion";
    protected $view = "vListaPublicacion";
     
    
    public function index()
    {

        return view('publicaciones.index')->with('cardTitle','Publicaciones')
                ->with('publicationList', $this->getPublicationList());
    }
    public function indexMyPublications()
    {
        $user_info = \Auth::user();
        return view('publicaciones.index')->with('cardTitle','Mis publicaciones')
                ->with('publicationList', $this->getMyPublicationList($user_info->id))
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
        return view('publicaciones.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $db = new publicacionDatabase();
        $user_info = \Auth::user();
        $var = new Publicacion();

        $var->setTitulo($request->input('titulo'));
        $var->setFecha($request->input('fecha'));
        $var->setHora($request->input('hora'));
        $var->setIdUbicacion($request->input('ubicacion'));
        //$var->setIdCiudad(1);
        $var->setDescripcion($request->input('descripcionLarga'));
        $var->setIdUsuario($user_info->id);
        $var->setIdPublicacionEstado($request->input('idPublicacionEstado'));
        
    
        
        $pathPublicacion = "users/".$user_info->id."/publicaciones/".time();
        Storage::makeDirectory($pathPublicacion);

        $media_file = $request->file('imgPublicacion');
        if($media_file)
        {
            //$media_file->getClientOriginalName()
            $name_file = time()."_".$user_info->id."_".substr($media_file->getClientOriginalName(), -5);
            $var->setPathImgVideo($pathPublicacion."/".$name_file);
            Storage::putFileAs($pathPublicacion, $media_file,$name_file);
           /* \Storage::disk($pathPublicacion)->put(
                $var->getPathImgVideo(),
                \File::get($media_file)
            );*/
        }else 
            $var->setPathImgVideo('');

        //$var->setPathImgVideo($request->photo->store('imgPublicacion'));
        

        $db->insert($var);
        
        return redirect('/my-publications');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$comentario = Comentario::find(1);
        //return var_dump($comentario);
        
        $publicacion = DB::table($this->view)->select()->where('idPublicacion', $id)->first();
        $data = new publicacion();
        $data->setIdPublicacion($publicacion->idPublicacion);
        //titulo cambia a tituloPublicacion por la vista vListaPublicacion
        $data->setTitulo($publicacion->tituloPublicacion);
        $data->setPathImgVideo($publicacion->pathImgVideo);
        $data->setFecha($publicacion->fecha);
        $data->setHora($publicacion->hora);
        $data->setDescripcion($publicacion->descripcion);
        $data->setCreated_at($publicacion->created_at);
        $data->setUpdated_at($publicacion->updated_at);
        $data->setIdUbicacion($publicacion->idUbicacion);
        $data->setIdPublicacionEstado($publicacion->idPublicacionEstado);
        $data->setIdUsuario($publicacion->idUsuario);
        //datos de la vista vListaPublicacion
        $data->setNombreUsuario($publicacion->name);
        $data->setTituloUbicacion($publicacion->tituloUbicacion);
        $data->setTituloPublicacionEstado($publicacion->tituloPublicacionEstado);
        $data->setTituloCiudad($publicacion->tituloCiudad);
        $data->setTituloCiudadCompleta($publicacion->tituloCiudadCompleto);
        //datos de la funcion antiguedad (dentro de la vista vListaPublicacion)
        $data->setAntiguedad($publicacion->antiguedad);
        
        if(!\Auth::guest())
        {
            if($data->getIdUsuario() == \Auth::user()->id)
                return view("publicaciones.show")->with('publicacionData', $data)->with('me',true);
            else
                return view("publicaciones.show")->with('publicacionData', $data)->with('me',false);
        }
        else
        {
             return view("publicaciones.show")->with('publicacionData', $data)->with('me',false);
        }
      
    
    }

    public function getPublicationList()
    {
        $db = new publicacionDatabase();
        $dbPublicacion = DB::table($this->view)->where($db->getIdPublicacionEstado(),3)
        ->orderBy('updated_at','desc')
        ->paginate(15);
        /*->select()
        ->where($db->getIdPublicacionEstado(),3)->get();*/
        $publicacionList = array();
        foreach($dbPublicacion as $publicacion)
        {
            $data = new publicacion();
            $data->setIdPublicacion($publicacion->idPublicacion);
            //titulo cambia a tituloPublicacion por la vista vListaPublicacion
            $data->setTitulo($publicacion->tituloPublicacion);
            $data->setPathImgVideo($publicacion->pathImgVideo);
            $data->setFecha($publicacion->fecha);
            $data->setHora($publicacion->hora);
            $data->setDescripcion($publicacion->descripcion);
            $data->setCreated_at($publicacion->created_at);
            $data->setUpdated_at($publicacion->updated_at);
            $data->setIdUbicacion($publicacion->idUbicacion);
            $data->setIdPublicacionEstado($publicacion->idPublicacionEstado);
            $data->setIdUsuario($publicacion->idUsuario);
            //datos de la vista vListaPublicacion
            $data->setNombreUsuario($publicacion->name);
            $data->setTituloUbicacion($publicacion->tituloUbicacion);
            $data->setTituloPublicacionEstado($publicacion->tituloPublicacionEstado);
            $data->setTituloCiudad($publicacion->tituloCiudad);
            $data->setTituloCiudadCompleta($publicacion->tituloCiudadCompleto);
            //datos de la funcion antiguedad (dentro de la vista vListaPublicacion)
            $data->setAntiguedad($publicacion->antiguedad);
            //agregar publicaciones al arreglo de objetos
            array_push($publicacionList, $data);

        }
        return $publicacionList;
    }
    public function getMyPublicationList($id)
    {
        $dbPublicacion = DB::table($this->view)
        ->where('idUsuario', $id)
        ->orderBy('updated_at','desc')
        ->paginate(15);
        /*$dbPublicacion = DB::table($this->view)
        ->select()
        ->where('idUsuario', $id)->get();*/
        $publicacionList = array();
        foreach($dbPublicacion as $publicacion)
        {
            $data = new publicacion();
            $data->setIdPublicacion($publicacion->idPublicacion);
            //titulo cambia a tituloPublicacion por la vista vListaPublicacion
            $data->setTitulo($publicacion->tituloPublicacion);
            $data->setPathImgVideo($publicacion->pathImgVideo);
            $data->setFecha($publicacion->fecha);
            $data->setHora($publicacion->hora);
            $data->setDescripcion($publicacion->descripcion);
            $data->setCreated_at($publicacion->created_at);
            $data->setUpdated_at($publicacion->updated_at);
            $data->setIdUbicacion($publicacion->idUbicacion);
            $data->setIdPublicacionEstado($publicacion->idPublicacionEstado);
            $data->setIdUsuario($publicacion->idUsuario);
            //datos de la vista vListaPublicacion
            $data->setNombreUsuario($publicacion->name);
            $data->setTituloUbicacion($publicacion->tituloUbicacion);
            $data->setTituloPublicacionEstado($publicacion->tituloPublicacionEstado);
            $data->setTituloCiudad($publicacion->tituloCiudad);
            $data->setTituloCiudadCompleta($publicacion->tituloCiudadCompleto);
            //datos de la funcion antiguedad (dentro de la vista vListaPublicacion)
            $data->setAntiguedad($publicacion->antiguedad);
            //agregar publicaciones al arreglo de objetos
            array_push($publicacionList, $data);

        }
        return $publicacionList;
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
        $publicacion = DB::table($this->view)->select()->where('idPublicacion', $id)->first();
        $data = new publicacion();
        $data->setIdPublicacion($publicacion->idPublicacion);
        //titulo cambia a tituloPublicacion por la vista vListaPublicacion
        $data->setTitulo($publicacion->tituloPublicacion);
        $data->setPathImgVideo($publicacion->pathImgVideo);
        $data->setFecha($publicacion->fecha);
        $data->setHora($publicacion->hora);
        $data->setDescripcion($publicacion->descripcion);
        $data->setCreated_at($publicacion->created_at);
        $data->setUpdated_at($publicacion->updated_at);
        $data->setIdUbicacion($publicacion->idUbicacion);
        $data->setIdPublicacionEstado($publicacion->idPublicacionEstado);
        $data->setIdUsuario($publicacion->idUsuario);
        //datos de la vista vListaPublicacion
        $data->setNombreUsuario($publicacion->name);
        $data->setTituloUbicacion($publicacion->tituloUbicacion);
        $data->setTituloPublicacionEstado($publicacion->tituloPublicacionEstado);
        $data->setTituloCiudad($publicacion->tituloCiudad);
        $data->setTituloCiudadCompleta($publicacion->tituloCiudadCompleto);
        //datos de la funcion antiguedad (dentro de la vista vListaPublicacion)
        $data->setAntiguedad($publicacion->antiguedad);

        
        return view("publicaciones.create")->with('publicacionData', $data)->with('editMode',true);

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
    
        $ajax = $request->input('ajax');

        $db = new publicacionDatabase();
        $user_info = \Auth::user();
        $var = new Publicacion();
        $var->setIdPublicacion($id);
        $var->setTitulo($request->input('titulo'));
        $var->setFecha($request->input('fecha'));
        $var->setHora($request->input('hora'));
        $var->setIdUbicacion($request->input('ubicacion'));
        //$var->setIdCiudad(1);
        $var->setDescripcion($request->input('descripcionLarga'));
        $var->setIdUsuario($user_info->id);
        $var->setIdPublicacionEstado($request->input('idPublicacionEstado'));
        
        
        $pathPublicacion = "users/".$user_info->id."/publicaciones/".time();
        Storage::makeDirectory($pathPublicacion);

        $media_file = $request->file('imgPublicacion');
        if($media_file)
        {
            //$media_file->getClientOriginalName()
            $name_file = time()."_".$user_info->id."_".substr($media_file->getClientOriginalName(), -5);
            $var->setPathImgVideo($pathPublicacion."/".$name_file);
            Storage::putFileAs($pathPublicacion, $media_file,$name_file);

            $db->updateAllData($var);
        }else 
            $db->updateOnlyInfo($var);

        if($ajax)
        {
            $actualizado = true;
            $data = array();
            array_push($data, $actualizado);
            return response()->json($data);
        }
        else {
            return redirect('/my-publications');
        }
        
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
