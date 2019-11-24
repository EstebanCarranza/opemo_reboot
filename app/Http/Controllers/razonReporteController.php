<?php

namespace App\Http\Controllers;
use App\Http\Database\razonReporteDatabase;
use Illuminate\Http\Request;
use App\Http\Models\razonReporte;

class razonReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $db = new razonReporteDatabase();
        $ciudades = $db->getList();
        return response()->json($ciudades);
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
        /*
        echo 
        "idRazonReporte:" .$request->input('idRazonReporte') . "<br>".
        "idPublicacion:" . $request->input('idPublicacion');
      */
        $db = new razonReporteDatabase();
        
        $db->reportarPublicacion(
            $request->input('idRazonReporte'),
            $request->input('idPublicacion')
        );
        return 'ok';
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
