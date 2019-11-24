@extends('layouts.cards')
@if(isset($cardTitle))
    @section('title', $cardTitle)
@endif
@if(!isset($me)) {{$me = false}} @endif
@section('body')
@foreach($publicationList as $publicacion)
<div class='col l4 m6 s12 animated-card card-row-custom-size'>
    @php
        switch ($publicacion->getIdPublicacionEstado()) {
            case 3:
                echo "<div class='card medium hoverable card-custom-size'>";
            break;
            case 6:
                echo "<div class='card medium hoverable card-custom-size orange lighten-5'>";
            break;
            default:
            echo "<div class='card medium hoverable card-custom-size'>";
        }
    @endphp
                <div class='card-image waves-effect waves-block waves-light'>
                    @if(substr($publicacion->getPathImgVideo(),-3) == "mp4")
                        <video controls class="" data-caption='{{$publicacion->getTitulo()}}' src="{{url('/image/publication?mode=1&id='.$publicacion->getIdPublicacion())}}"></video>
                    @else
                        <img class='activator' src={{ url('/image/publication?mode=1&id='.$publicacion->getIdPublicacion()) }}>
                    @endif
                </div>
                <div class='card-content'>
                    <a href="#" class=""><i class='material-icons right activator'>more_vert</i></a>
                    <span class='card-title  grey-text text-darken-4 truncate'>{{$publicacion->getTitulo()}}</span>
                     @if($publicacion->getIdPublicacionEstado() == 6) <span><strong>[BORRADOR]</strong></span> @endif
                        
                        <a href="{{url('/publication-list/'.$publicacion->getIdPublicacion())}}">Ver</a>
                        @if($me)&nbsp;<a href={{url('/publication-list/'.$publicacion->getIdPublicacion().'/edit')}}>Editar</a>@endif
                        
                    <div class="card-footer">                        
                        <small class="text-muted truncate">
                            {{$publicacion->getAntiguedad()}}&nbsp;<br>
                            {{$publicacion->getTituloUbicacion()}},
                            {{$publicacion->getTituloCiudadCompleta()}}<br>
                             Publicado por:
                         <a href="{{url('/profile/'.$publicacion->getIdUsuario())}}">{{$publicacion->getNombreUsuario()}}</a>
                        </small>
                    </div>
                </div>
                <div class='card-reveal'>
                    <div><i class='material-icons right card-title'>close</i></div>
                    <span class='card-title grey-text text-darken-4'>{{$publicacion->getTitulo()}}</span>
                    
                    <p class="flow-text">
                        {{$publicacion->getDescripcion()}}
                    </p>  
                    <div class="card-footer">
                        <small class="text-muted truncate">
                            {{$publicacion->getAntiguedad()}}&nbsp;<br>
                            {{$publicacion->getTituloUbicacion()}},
                            {{$publicacion->getTituloCiudadCompleta()}}
                        </small>
                        <small class="text-muted">
                            Publicado por: 
                            <a href="{{url('/profile/'.$publicacion->getIdUsuario())}}">
                                {{$publicacion->getNombreUsuario()}}
                            </a>
                    </small>
                    </div>
                </div>
            </div>
        </div>
@endforeach
@if($me)
<div class="fixed-action-btn">
        <a class="btn-floating btn-large orange" href="{{url('/publication-list/create')}}">
            <i class="large material-icons">add</i>
        </a>
    </div>
@endif

 
@stop
@section('pagination')
    @include('inc.pagination')
@stop