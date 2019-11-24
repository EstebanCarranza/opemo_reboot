<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Publicacion;
use Illuminate\Support\Facades\DB;

class busquedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResults(Request $request)
    {
        $whereData = array();
        if($request->titulo)
        {
            //array_push($whereData, ['name', 'LIKE','%'.$request->titulo.'%']);
            array_push($whereData, ['tituloPublicacion', 'LIKE','%'.$request->titulo.'%']);
            //array_push($whereData, ['tituloUbicacion', 'LIKE','%'.$request->titulo.'%']);
            //array_push($whereData, ['tituloCiudadCompleto', 'LIKE','%'.$request->titulo.'%']);
        }
        if($request->descripcion)
            array_push($whereData, ['descripcion', 'LIKE','%'.$request->descripcion.'%']);
        if($request->hora)
            array_push($whereData, ['hora', 'LIKE','%'.$request->hora.'%']);
        if($request->fecha)
            array_push($whereData, ['fecha', 'LIKE','%'.$request->fecha.'%']);
        if($request->ubicacion)
        {
            array_push($whereData, ['tituloPublicacion', 'LIKE', '%'.$request->ubicacion.'%']);
            //array_push($whereData, ['tituloUbicacion', 'LIKE', '%'.$request->ubicacion.'%']);
        }
        if($request->municipio)
            array_push($whereData, ['tituloCiudad', 'LIKE','%'.$request->municipio.'%']);

        
        $db = DB::table('vResultadosBusqueda')
        ->where($whereData)->paginate(15);
        if(count($db)== 0)
        {
            $db = ['current_page' => 0];
        }
        return response()->json($db);
    }
    public function index()
    {
        return view('pages.results')->with('cardTitle', 'Resultados de búsqueda');
       
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
