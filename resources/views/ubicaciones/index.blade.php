@extends('layouts.cards')
@if(isset($cardTitle))
    @section('title', $cardTitle)
@endif
@if(!isset($me)) {{$me = false}} @endif
@section('body')
@foreach($ubicationList as $ubicacion)
<div class='col l4 m6 s12 animated-card card-row-custom-size'>
            <div class='card medium hoverable card-custom-size'>
                <div class='card-image waves-effect waves-block waves-light'>
                    <img class='activator' src={{ url('/image/ubication?id='.$ubicacion->getIdUbicacion()) }}>
                </div>
                <div class='card-content'>
                    <a href="#" class=""><i class='material-icons right activator'>more_vert</i></a>
                    <span class='card-title  grey-text text-darken-4 truncate'>{{$ubicacion->getTitulo()}}</span>
                    <p>
                        <a href="{{url('/ubications/'.$ubicacion->getIdUbicacion())}}">Abrir</a>
                        @if($me)&nbsp;&nbsp;<a href="{{url('/ubications/'.$ubicacion->getIdUbicacion().'/edit')}}">Editar</a>@endif
                    </p>
                    <div class="card-footer">
                        <small class="text-muted truncate">
                            {{$ubicacion->getAntiguedad()}} <br>
                            {{$ubicacion->getTituloCiudadCompleta()}}
                        </small>
                    </div>
                </div>
                <div class='card-reveal'>
                    <div><i class='material-icons right card-title'>close</i></div>
                    <span class='card-title grey-text text-darken-4'>{{$ubicacion->getTitulo()}}</span>
                    <p class="flow-text">
                        {{$ubicacion->getDescripcion()}}
                    </p>  
                    <div class="card-footer">
                        <small class="text-muted truncate">
                            {{$ubicacion->getAntiguedad()}} &nbsp;
                            {{$ubicacion->getTituloCiudadCompleta()}}
                        </small>
                    </div>
                </div>
            </div>
        </div>
@endforeach
@if($me)
<div class="fixed-action-btn">
        <a class="btn-floating btn-large orange" href="{{url('/ubications/create')}}">
            <i class="large material-icons">add</i>
        </a>
    </div>
@endif
@stop
@section('pagination')
    @include('inc.pagination')
@stop


