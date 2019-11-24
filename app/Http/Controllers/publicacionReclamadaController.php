<?php

namespace App\Http\Controllers;
use App\Http\Models\PublicacionReclamada;
use App\Http\Database\publicacionReclamadaDatabase;
use Illuminate\Http\Request;

class publicacionReclamadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('messages.index');
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
        
        $db = new publicacionReclamadaDatabase();
        $user_info = \Auth::user();
        $var = new PublicacionReclamada();

        $ajax = $request->input('ajax');
        $var->setDescripcion($request->input('descripcion'));
        $var->setIdPublicacion($request->input('idPublicacion'));
        $var->setIdUsuarioReclamador($user_info->id);

        
        $idPublicacionReclamada = $db->insert($var);
        $var->setIdPublicacionReclamada($idPublicacionReclamada);
        
        if($var->getIdPublicacionReclamada() != -1)
        {
            if($ajax)
            {
                $dataPub = array(
                    'actualizado' => true,
                    'idPublicacion' => $var->getIdPublicacion(),
                    'descripcion' => $var->getDescripcion(),
                    'idUsuarioReclamador'=>$var->getIdUsuarioReclamador(),
                    'idPublicacionReclamada' => $var->getIdPublicacionReclamada()
                );
                
                return response()->json($dataPub);
            }else
            {
                return redirect('publication-list/'.$var->getIdPublicacion());
            }
        }else
        {
            return redirect('dashboard');
        }
      
            
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
