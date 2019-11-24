<?php

namespace App\Http\Controllers;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Ubicacion;
use App\Http\Database\ubicacionDatabase;
use App\Http\Database\comentarioDatabase;
use App\Http\Database\publicacionReportadaDatabase;
use App\Http\Database\publicacionReclamadaDatabase;
//use App\Mail;
use \App\Mail\EnviarCorreos;
///use Mail;
use Illuminate\Support\Facades\Mail;


class helperDataController extends Controller
{
    
    public function __constructor()
    {

    }
    public function index()
    {
       
    }
    public function enviarCorreo(Request $request)
    {
        //Mail::to(['esteban.carranza@outlook.com'])->send("");
        if($request->id)
        {
            $dbUsuario = DB::table('users')->select()->where('id',$request->id)->first();
            \Mail::send('mail.index',array(
             'usuario'=>$dbUsuario), function($message)
            {
                //$message->from('your@gmail.com');
                $message->to('esteban.carranza@outlook.com', 'Esteban')->subject('Nuevo inicio de sesión');
            });
            return response()->json(['enviarCorreo'=>true]);
        }else {
            return response()->json(['enviarCorreo'=>false]);
        }
         
    }
    public function bloquearPublicacionReportada(Request $request)
    {
        if($request->id)
        {
            DB::table('tbl_publicacionReportada')
                ->where('idPublicacion',$request->id)
                ->delete();
            DB::table('tbl_publicacion')
                ->where('idPublicacion',$request->id)
                ->update(['idPublicacionEstado'=>1]);
            
        }
        return redirect('publication-reports');
    }
     public function getUbications()
    {
        $data = new Ubicacion();
        $dbUbicacion = new ubicacionDatabase();
        $ubiData = DB::table($data->getTableName())
            ->select($dbUbicacion->getIdUbicacion(), $dbUbicacion->getTitulo())->get();

         return response()->json($ubiData);
    }
    public function getUbicationsForUser()
    {
        $user_info = \Auth::user();
        $data = new Ubicacion();
        $dbUbicacion = new ubicacionDatabase();
        $ubiData = DB::table($data->getTableName())
            ->select($dbUbicacion->getIdUbicacion(), $dbUbicacion->getTitulo())
                ->where($dbUbicacion->getIdUsuario(), $user_info->id)->get();

         return response()->json($ubiData);
    }
    public function getCommentList(Request $request)
    {
        if($request->id)
        {
            $dbComentarios = new comentarioDatabase();
            $comentarios = $dbList = DB::table($dbComentarios->getView())->select()
                ->where($dbComentarios->getIdPublicacion(), $request->id)
                ->orderBy('created_at', 'asc')
                ->get();
            
            return response()->json($comentarios);
            //return var_dump($comentarios);
        }
       
    }
    public function getPuReLi(Request $request)
    {
        //get Publication Report List
        $dbPublicacionReportada = new publicacionReportadaDatabase();
        $lista = DB::table($dbPublicacionReportada->getView())->select()
                ->orderBy('updated_at', 'desc')
                ->get();
            
        return response()->json($lista);
    }
    public function getPuMeLi(Request $request)
    {
        //get Publication Message List
        //$dbPublicacionReportada = new publicacionReportadaDatabase();
        $lista = DB::table('vListaPublicacionReclamada')->select()
                ->where('idPublicacionEstado',7)
                ->where('idUsuario', \Auth::user()->id)
                ->orWhere('idUsuarioReclamador',\Auth::user()->id)
                ->orderBy('updated_at', 'desc')
                ->get();
            
        return response()->json($lista);
    }
    public function deleteReclam(Request $request)
    {
        if($request->id)
        {
            DB::table('tbl_mensajes')->where('idPublicacionReclamada',$request->id)->delete();
            DB::table('tbl_publicacionReclamada')->where('idPublicacionReclamada', $request->id)->delete();
            DB::table('tbl_publicacion')->where('idPublicacion',$request->idPublicacion)->update(['idPublicacionEstado'=>3]);
        }
        return redirect('messages');
    }
    public function getPuntuacion(Request $request)
    {
        if($request->id)
        {
            $lista = DB::table('vPuntuacion')->select()->where('idUsuario', $request->id)->first();
            if($lista)
                return response()->json($lista);
            else
            {
                $lista = ['puntuacion'=>0, 'idUsuario'=>0];
                return response()->json($lista);
            }
        }
    }
    public function getTestimonio(Request $request)
    {
       
            $lista = DB::table('tbl_testimonio')->select()->where('mostrarTestimonio', true)->get();
            if($lista)
                return response()->json($lista);
            else
            {
                $lista = ['idTestimonio'=>0, 'descripcion'=>"No encontrado"];
                return response()->json($lista);
            }
       
    }
   
}
