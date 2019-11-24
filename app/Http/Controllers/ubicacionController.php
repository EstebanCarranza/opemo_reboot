<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Models\Ubicacion;
use App\Http\Database\ubicacionDatabase;

class ubicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $db = new ubicacionDatabase();
        return view ('ubicaciones.index')->with('cardTitle','Ubicaciones')
        ->with('ubicationList', $db->getUbicationList());
    }
    public function indexMyUbications()
    {
        $user_info = \Auth::user();
        $db = new ubicacionDatabase();
        return view ('ubicaciones.index')->with('cardTitle','Mis ubicaciones')
        ->with('ubicationList', $db->getMyUbicationList($user_info->id))
        ->with('me', true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ubicaciones.create');
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
        $user_info = \Auth::user();
        $var = new Ubicacion();
        $db = new ubicacionDatabase();

        $var->setTitulo($request->input('titulo'));
        $var->setDescripcion($request->input('descripcionLarga'));
        $var->setIdCiudad($request->input('municipio'));
        //$var->setPathUbicacion($request->input('imgUbicacion'));
        
        $var->setIdUsuario($user_info->id);
        
        $pathUbicacion = "users/".$user_info->id."/ubicaciones/".time();
        Storage::makeDirectory($pathUbicacion);

        $media_file = $request->file('imgUbicacion');
        if($media_file)
        {
            //$media_file->getClientOriginalName()
            $name_file = time()."_".$user_info->id."_".substr($media_file->getClientOriginalName(), -5);
            $var->setPathUbicacion($pathUbicacion."/".$name_file);
            Storage::putFileAs($pathUbicacion, $media_file,$name_file);
        }else 
            $var->setPathUbicacion('/defaultData/cover.png');

        if($db->insert($var)){return redirect('/my-ubications');}
        else {return view('pages.errors')->with('error_message', 'No se pudo subir el contenido intenta más tarde');}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $var = new Ubicacion();
        $db = new ubicacionDatabase();
        $var = $db->getUbicationForId($id);
        return view('ubicaciones.show')->with('ubicacion', $var);
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
        $var = new Ubicacion();
        $db = new ubicacionDatabase();
        $var = $db->getUbicationForId($id);
        return view('ubicaciones.create')
        ->with('editMode', true)
        ->with('ubicacion', $var);
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
        //
       $user_info = \Auth::user();
        $var = new Ubicacion();
        $db = new ubicacionDatabase();

        $var->setIdUbicacion($id);
        $var->setTitulo($request->input('titulo'));
        $var->setDescripcion($request->input('descripcionLarga'));
        $var->setIdCiudad($request->input('municipio'));
       // $var->setPathUbicacion($request->input('imgUbicacion'));
        
        $var->setIdUsuario($user_info->id);

        $media_file = $request->file('imgUbicacion');
        if($media_file)
        {
            $pathUbicacion = "users/".$user_info->id."/ubicaciones/".time();
            Storage::makeDirectory($pathUbicacion);
            //$media_file->getClientOriginalName()
            $name_file = time()."_".$user_info->id."_".substr($media_file->getClientOriginalName(), -5);
            $var->setPathUbicacion($pathUbicacion."/".$name_file);
            Storage::putFileAs($pathUbicacion, $media_file,$name_file);
            if($db->updateAllData($var)){return redirect('/my-ubications');}
        }
        else 
        {
            if($db->updateOnlyInfo($var)){return redirect('/my-ubications');}
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
