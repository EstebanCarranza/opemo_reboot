@extends('layouts.master')
@section('title', 'OPEMO')
@section('content')
<div class="col s12">
<h4>¿Quiénes somos?</h4>
<p class="flow-text">
    Objetos perdidos monterrey mejor conocida como "OPEMO" somos una empresa sin fines de lucro que se dedica a facilitar la recuperación de objetos perdidos 
    en Monterrey y su área metropolitana. ¿Cómo? Haciendo una comunidad donde cada usuario puede publicar el objeto encontrado por medio de una imagen o video.
</p>
</div>
<div class="col s12">
    <h4>Testimonios</h4>
</div>
<?php

?>
@if(isset($testimoniosList))
    @foreach($testimoniosList as $testimonio)
    <div class="col l4 m6 s12">
        <div class="card card-testimonio">
            <div class="card-content">
                <span class="card-title">{{$testimonio->getTitulo()}}</span>
                <p>
                    {{$testimonio->getDescripcion()}}
                </p>
            </div>
        </div>
    </div>
    @endforeach
@endif
<script>
    $(document).ready(function()
    {
        $('#slide-out').sidenav('open');
    });
</script>
@stop