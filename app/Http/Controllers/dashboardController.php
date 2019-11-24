<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $cardsData = array();
    protected function getCardsForUser()
    {
        array_push(
            $this->cardsData, 
            array
            (
                'title' => 'Mi perfil',
                'link' => '/profile',
                'description' => 'Aquí podrás ver los mensajes de conversación sobre los reclamos que hayas hecho'
            )
        );
        array_push(
            $this->cardsData, 
            array
            (
                'title' => 'Reclamos',
                'link' => '/messages',
                'description' => 'Aquí podrás ver los reclamos que has hecho'
            )
        );
        array_push(
            $this->cardsData, 
            array
            (
                'title' => 'Mis publicaciones',
                'link' => '/my-publications',
                'description' => 'Aquí podrás ver, crear, editar y eliminar tus publicaciones creadas'
            )
        );
        array_push(
            $this->cardsData, 
            array
            (
                'title' => 'Mis ubicaciones',
                'link' => '/my-ubications',
                'description' => 'Aquí podrás ver, crear, editar y eliminar tus ubicaciones creadas'
            )
        );
        /*
        array_push(
            $this->cardsData, 
            array
            (
                'title' => 'Mis objetos recuperados',
                'link' => '/my-recovery-objects',
                'description' => 'Aquí podrás ver los objetos que has recuperado en opemo'
            )
        );*/
        
        return $this->cardsData;
    }
    protected function getCardsForAdmin()
    {
        array_push(
            $this->cardsData, 
            array
            (
                'title' => 'Publicaciones reportadas',
                'link' => '/publication-reports',
                'description' => 'Aquí podrás ver y bloquear las publicaciones que han sido reportadas por la comunidad'
            )
        );
        /*
        array_push(
            $this->cardsData, 
            array
            (
                'title' => 'Lista de usuarios',
                'link' => '/users-list',
                'description' => 'Aquí podras visualizar la lista de usuarios dados de alta en la página'
            )
        );*/
        return $this->cardsData;
    }

    public function index()
    {
        //
        if(\Auth::guest())
            return redirect('/');
        else
        {

            $this->getCardsForUser();
            if(\Auth::user()->idNivelAcceso == 2)
                $this->getCardsForAdmin();
            
            return view('pages.dashboard')->with('cardsData',$this->cardsData);
        }
            
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
        return view('pages.dashboard')->with('cardsData',$this->getData());
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
