@extends('layouts.master')
<?php $title = "titulo"; ?>
@section('title', 'Dashboard')
@section('content')
<div class="card-panel z-depth-0 col s12">
    <div class="row">
        @if(isset($cardsData))
        @for ($i = 0; $i < count($cardsData);$i++)
            <div class="col l4 m6 s12">
                <div class="card card-control-panel card-dashboard">
                    <div class="card-content">
                    <a class="activator"><i class="material-icons right">more_vert</i></a>
                    <span class="card-title activator grey-text text-darken-4">
                        {{$cardsData[$i]["title"]}}
                    </span>
                    <p><a href={{$cardsData[$i]["link"]}}>Abrir</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">{{$cardsData[$i]["title"]}}<i class="material-icons right">close</i></span>
                        <p>
                            {{$cardsData[$i]["description"]}}
                        </p>
                    </div>
                </div>
            </div>
        @endfor
        @else
            <h5>Recarga la página en un momento cargara el panel de control :)</h5>
        @endif
    </div>
</div>
<script>
  $(document).ready(function()
  {

    if(localStorage.getItem('sendMail')==null)
    {
        localStorage.setItem('sendMail',false);
        sendEmailAuth();
    }
    if(!localStorage.getItem('sendMail'))
    {
        sendEmailAuth();
    }
    function sendEmailAuth()
    {
        var dataToSend = {
            id : {{Auth::user()->id}}
        };
      $.ajax({
        url: "{{url('/enviar-correo')}}",
        async: 'true',
        type: 'GET',
        data:dataToSend,
        dataType: 'json',

        success: function (respuesta) {
            alert(JSON.stringfy(respuesta));
            localStorage.setItem('sendMail',true);
        },
        error: function (x, h, r) {
            console.log('No se pudo enviar el correo' + "Error: " + x + h + r);
            //alert("Error: " + x + h + r);            
        }

        });
    }

    
   
  });
</script>
@stop