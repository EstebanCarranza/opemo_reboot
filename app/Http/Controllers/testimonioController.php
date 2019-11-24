<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\testimonioModel;
use App\Http\Controllers\Auth;

class testimonioController extends Controller
{
    //protected $redirectTo = '/dashboard';
    public function __construct()
    {
       //$this->middleware('auth');
    }
    
    function index()
    {
        //$this->middleware('auth');
         //$this->middleware('guest');
        $testimonios = DB::table('tbl_testimonio')->select('titulo','descripcion','idTestimonio')->where('mostrarTestimonio', true)->get();
        $testimoniosList = array();
        
        foreach($testimonios as $testimonio)
        {
            $data = new testimonioModel();
            $data->setTitulo($testimonio->titulo);
            $data->setDescripcion($testimonio->descripcion);
            $data->setIdTestimonio($testimonio->idTestimonio);   
            array_push($testimoniosList, $data);
            //echo $data->titulo . "- " . $data->descripcion . "<br>";
        }
        //echo var_dump($testimoniosList) . "<br>";
        
        
        /*
        foreach($testimoniosList as $testimonio)
        {
            echo  $testimonio->getTitulo(). "<br>";
           
        }*/
        if(!\Auth::User())
        return view('pages.landingpage')->with('testimoniosList',$testimoniosList)->with('showCarousel',true);
        else
        return redirect('dashboard');
        
        
    }   
}
