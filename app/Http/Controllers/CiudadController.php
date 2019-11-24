<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Ciudad;

class ciudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function getAreaMetropolitana()
    {
        $table = DB::table($table)->where('areaMetropolitana', true);
        return $table;
    }*/
    
    public function index()
    {
        $ciudades = DB::table('tbl_ciudad')->select('idCiudad','titulo')->where('areaMetropolitana', true)->get();
        /*$ciudadList = array();
        foreach($ciudades as $ciudad)
        {
            $ciudadM = new Ciudad();
            $ciudadM->setIdCiudad($ciudad->idCiudad);
            $ciudadM->setTitulo($ciudad->titulo);

            array_push($ciudadList, $ciudadM);
            //echo  $ciudad->idCiudad. " - " . $ciudad->titulo . "<br>";

        }*/
        /*header('Content-Type: application/json');
        return $ciudadList[0]->toJson();*/
        return response()->json($ciudades);
        
        //$ciudadM = new Ciudad();
            
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
