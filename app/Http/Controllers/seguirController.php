<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Models\Seguir;
use App\Http\Database\seguirDatabase;

class seguirController extends Controller
{
    //
    public function getSeguidoresList(Request $request)
    {
        if($request->id)
        {
            $dbListaSeguidores = \DB::table('vSeguir')->select()
                ->where('idUsuarioSiguiendo',$request->id)
                ->get();
        }
        
        
        return response()->json($dbListaSeguidores);
        
    }
    public function getSiguiendoList(Request $request)
    {
        if($request->id)
        {
            $dbListaSiguiendo = \DB::table('vSeguir')->select()
                ->where('idUsuarioSeguidor', $request->id)
                ->get();
            
            return response()->json($dbListaSiguiendo);
        }
        
    }

    public function getSeguir($id)
    {
        $user_info = \Auth::User();
        $db = new seguirDatabase();
        $sigue = \DB::table($db->getTable())->select()
            ->where($db->getIdUsuarioSeguidor(), $user_info->id)
            ->where($db->getIdUsuarioSiguiendo(),$id)
            ->first();
        
        if($sigue)
            return true;
        else
            return false;
        
    }
    public function seguir(Request $request)
    {
        if($request->idUsuarioSiguiendo)
        {
            $user_info = \Auth::User();
            $dbSeguir = new seguirDatabase();
            $data = new Seguir();
            $sigue = \DB::table($dbSeguir->getTable())->select()
            ->where($dbSeguir->getIdUsuarioSeguidor(), $user_info->id)
            ->where($dbSeguir->getIdUsuarioSiguiendo(),$request->idUsuarioSiguiendo)
            ->first();

            
            $data->setIdUsuarioSeguidor($user_info->id);
            $data->setIdUsuarioSiguiendo($request->idUsuarioSiguiendo);

            if($sigue)
            {
                $data->setIdSeguir($sigue->idSeguir);
                
                DB::table($dbSeguir->getTable())
                    ->where($dbSeguir->getIdSeguir(), $data->getIdSeguir())
                    ->where($dbSeguir->getIdUsuarioSeguidor(), $data->getIdUsuarioSeguidor())
                    ->where($dbSeguir->getIdUsuarioSiguiendo(), $data->getIdUsuarioSiguiendo())
                    ->delete();
               //return back()->withInput(['id' => $data->getIdUsuarioSiguiendo(), 'seguir'=>true]);
               $seguir = true;
               $data = array();
                array_push($data, $seguir);
                return response()->json($data);
               //return back();
            }
            else {
                    DB::table($dbSeguir->getTable())->insert(
                        array(
                                $dbSeguir->getIdUsuarioSeguidor() => $data->getIdUsuarioSeguidor(),
                                $dbSeguir->getIdUsuarioSiguiendo() => $data->getIdUsuarioSiguiendo(),
                                $dbSeguir->getCreated_at()  => $data->getCreated_at(),
                                $dbSeguir->getUpdated_at() => $data->getUpdated_at()
                        )
                    );
                   // return back()->withInput(['id' => $data->getIdUsuarioSiguiendo(), 'seguir' => false]);
                   $seguir = false;
                   $data = array();
                   array_push($data, $seguir);
                   return response()->json($data);
                   //return back();
            }
                    
        }
    }
    
}
