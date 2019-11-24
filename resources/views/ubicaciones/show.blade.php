@extends('layouts.master')
@section('content')
    <div class="row card-panel">
        <div class="col l6">
            <img id="imagen-ubicacion-vista-previa" class="col l12 s12 materialboxed" src="{{url('/image/ubication?id='.$ubicacion->getIdUbicacion())}}">
            <div class="col s12 l12">    
                <a href="{{url('/profile/'.$ubicacion->getIdUsuario())}}">
                    <div class="card-panel z-depth-1 report-size ">
                        <div class="row valign-wrapper">
                            <div class="col s2">
                                <img src="{{url('/image/profile/avatar?id='.$ubicacion->getIdUsuario())}}" alt="" class="circle responsive-img">
                            </div>
                            <div class="col s10">
                                <div class="black-text">
                                    {{$ubicacion->getAlias()}}
                                </div>
                                <div>
                                    <i id="star-1" value="1" class='star black-text material-icons'>star</i>
                                    <i id="star-2" value="2" class='star black-text material-icons'>star</i>
                                    <i id="star-3" value="3" class='star black-text material-icons'>star</i>
                                    <i id="star-4" value="4" class='star black-text material-icons'>star</i>
                                    <i id="star-5" value="5" class='star black-text material-icons'>star</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col l6 s12">
            <div class="col s12">
                <h3>
                    {{$ubicacion->getTitulo()}}
                </h3>
            </div>
            <div class="col s12">
                <h5>Descripción</h5>
                {{$ubicacion->getDescripcion()}}
            </div>
            <div class="col s12">
                <h5>Municipio</h5>
                {{$ubicacion->getTituloCiudadCompleta()}}
            </div>
            
            <div class="col s12">
                <h5>Antiguedad</h5>
                {{$ubicacion->getAntiguedad()}}
            </div>
            <div class="col s12">
                <h5>Fecha y hora</h5>
                {{$ubicacion->getCreated_at()}}
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        $('.materialboxed').materialbox();
        
    getPuntuacion();
    function getPuntuacion()
    {
      $.ajax({
        url: "{{url('/puntuacion-total?id='.$ubicacion->getIdUsuario())}}",
        async: 'true',
        type: 'GET',
        dataType: 'json',

        success: function (respuesta) {
            debugger;
            $(".star").removeClass("black-text");
            $(".star").removeClass("orange-text");
          var data = respuesta.puntuacion;
          estrellas = 0;
          switch(data)
          {
            case "1": {
             // debugger;
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("black-text");
              $("#star-3").addClass("black-text");
              $("#star-4").addClass("black-text");
              $("#star-5").addClass("black-text");
              estrellas = 1;
              }
            break;
            case "2": {
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("orange-text");
              $("#star-3").addClass("black-text");
              $("#star-4").addClass("black-text");
              $("#star-5").addClass("black-text");
              estrellas = 2;
              }
            break;
            case "3": {
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("orange-text");
              $("#star-3").addClass("orange-text");
              $("#star-4").addClass("black-text");
              $("#star-5").addClass("black-text");
              estrellas = 3;
              }
            break;
            case "4": {
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("orange-text");
              $("#star-3").addClass("orange-text");
              $("#star-4").addClass("orange-text");
              $("#star-5").addClass("black-text");
              estrellas = 4;
              }
            break;
            case "5": {
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("orange-text");
              $("#star-3").addClass("orange-text");
              $("#star-4").addClass("orange-text");
              $("#star-5").addClass("orange-text");
              estrellas = 5;
              }
            break;
            default:{
                $("#star-1").addClass("black-text");
                $("#star-2").addClass("black-text");
                $("#star-3").addClass("black-text");
                $("#star-4").addClass("black-text");
                $("#star-5").addClass("black-text");
                estrellas = 0;
            }break;
          }
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);

        }

        });
    }   
    });
    </script>
@stop