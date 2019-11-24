@extends('layouts.master')
@section('title', $publicacionData->getTitulo())
@section('content')
<div class ="row"><h3 class="col s12 flow-text center">{{$publicacionData->getTitulo()}}</h3></div>
   
<div class="row card-panel">
    <div class="col l6">
    @if(substr($publicacionData->getPathImgVideo(),-3) == "mp4")
        <video controls class="col l12 s12 materialboxed" data-caption='{{$publicacionData->getTitulo()}}' src="{{url('/image/publication?mode=1&id='.$publicacionData->getIdPublicacion())}}"></video>
    @else
        <img class="col l12 s12 materialboxed" data-caption='{{$publicacionData->getTitulo()}}' src="{{url('/image/publication?mode=1&id='.$publicacionData->getIdPublicacion())}}">
    @endif
    <div class="col s12 l12">    
        <a href="{{url('/profile/'.$publicacionData->getIdUsuario())}}">
            <div class="card-panel z-depth-1 report-size ">
                <div class="row valign-wrapper">
                    <div class="col s2">
                        <img src="{{url('/image/profile/avatar?id='.$publicacionData->getIdUsuario())}}" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
                    </div>
                    <div class="col s10">
                        <div class="black-text">
                            {{$publicacionData->getNombreUsuario()}}
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
    <div class="col l6 s12 ">
        <h5 class='card-title flex-content'>Fecha y hora</h5>
            <p class='cart-text flex-content'>{{$publicacionData->getFecha()}}&nbsp;{{$publicacionData->getHora()}}</p>
        <h5 class='card-title flex-content'>Ubicación</h5>
            <p class='card-text flex-content'>{{$publicacionData->getTituloUbicacion()}}</p>
        <h5 class='card-title flex-content'>Municipio</h5>
            <p class='card-text flex-content'>{{$publicacionData->getTituloCiudadCompleta()}}</p>
        <h5 class='card-title flex-content'>Descripción larga</h5>
            <p class='cart-text flex-content'>
                {{$publicacionData->getDescripcion()}}
            </p>
    </div>     
    @if(!Auth::guest() && !$me)
        <div class="col l6 offset-l6 s12 row">
            <a id="reportarPublicacion" class="col l12 m12 s12 waves-effect waves-light btn red modal-trigger" href="#reportar">
                Reportar publicación <i class="material-icons right">report</i>
            </a>
        </div>
        <div class="col l6 offset-l6 s12 row">
            <a id="reclamarObjeto" class="col l12 m12 s12 waves-effect waves-light btn orange modal-trigger" href="#mdlContactar">
                <i class="material-icons right">question_answer</i> Reclamar objeto
            </a>
        </div>
    @endif
</div>





 <div id="commentList"></div>
@if(!Auth::guest())
<div class="row card-panel z-depth-1">
    <div class="col s12">
        <div class="z-depth-0">
            <div class="row valign-wrapper">
                <div class="col s2">
                    
                    <img src="{{url('/image/profile/avatar?id='.\Auth::user()->id)}}" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
                </div>
                <div class="col s10">
                    <div  class="black-text">
                    {{\Auth::user()->name}}
                    </div>
                    <div>
                        <div class="input-field col l12 s12">
                            
                            <input id="pubComentario" name="comentario" type="text" class="validate" required>
                            <label for="pubComentario">Comentario</label>
                            <p>
                                <a id="btnCrearComentario" class="disabled col offset-s10 s2 waves-effect waves-light btn orange">
                                    <i class="material-icons">comment</i>
                                </a>
                            </p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal Structure -->
  <div id="reportar" class="modal modal-fixed-footer">
    <form method="post" action="{{url('/razonReporte')}}">
        {{csrf_field()}}
        <div class="modal-content">
            <h4>Razón del reporte</h4>
            <p>Especifica la razón por la cual estás haciendo el reporte, recuerda ser claro y conciso</p>
            <div class="input-field col s12">
                <input type="hidden" id="idPublicacion" name="idPublicacion" value="{{$publicacionData->getIdPublicacion()}}">
                <select name="idRazonReporte" class="insert-razonReporte" id="idRazonReporte">
                </select>
                <label>Elige una razon de reporte</label>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-close waves-effect waves-green btn-flat">Cerrar ventana</a>
            <a id="btnReportar" class="disabled modal-close waves-effect waves-green btn-flat">Reportar publicación</a>
        </div>
    </form>
  </div>

  <!-- Modal Structure -->
  <div id="msgReporte" class="modal white green-text">
    <div class="modal-content center">
      
        <i class="material-icons large  green-text">check_circle</i>
        <h5 id="msgReporteTitle">Reporte realizado correctamente</h5>
    </div>
    <div class="modal-footer white green-text">
      <a href="#!" class="modal-close waves-effect waves-orange btn-flat orange-text">Cerrar</a>
    </div>
  </div>

    <!-- Modal Structure -->
  <div id="mdlContactar" class="modal modal-fixed-footer">
    <form method="POST" action="{{url('reclamo')}}">
        {{ csrf_field() }}
        <div class="modal-content">
        <h4>Contactar a {{$publicacionData->getNombreUsuario()}}</h4>
        <div class="input-field col s12">
                <input type="hidden" name="idPublicacion" value="{{$publicacionData->getIdPublicacion()}}">
            <textarea name="descripcion" id="txtContactar" class="materialize-textarea"></textarea>
            <label for="txtContactar">
                Escribe un mensaje para que {{$publicacionData->getNombreUsuario()}}
                entienda la razón de tu reclamo
            </label>
            </div>  
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-close waves-effect waves-orange btn-flat">Cerrar ventana</a>
            <a id="btnMensaje" href="#!" class="modal-close waves-effect waves-orange btn-flat">
            <i class="material-icons right">question_answer</i>Enviar mensaje
        </a>
        </div>
    </form>
  </div>
          
@endif



 <script>
$(document).ready(function(){
    $('.materialboxed').materialbox();
    $('.modal').modal();
    $('input#input_text, textarea#txtContactar').characterCounter();


    getRazonReporte();
    function getRazonReporte()
    {
      $.ajax({
        url: '/razonReporte',
        async: 'true',
        type: 'GET',
        dataType: 'json',

        success: function (respuesta) {
          
            $(".insert-razonReporte").append("<option selected value='-1' disabled>Elige una razon de reporte</option>");
          
          for(var i = 0; i < respuesta.length; i++)
          {
            //agregar el option al combo de html
              $(".insert-razonReporte").append("<option value='"+respuesta[i].idRazonReporte+"'>"+respuesta[i].titulo+"</option>");
            //actualizar el combobox de materialized
            $('select').formSelect();

          } 
          
            //$(".insert-razonReporte").html(respuesta);
            //debugger;
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);

        }

        });
    }
    $("#idRazonReporte").change(function()
    {
        if($("#idRazonReporte").find(":selected").val() != -1)
            $("#btnReportar").removeClass("disabled");
        else
            $("#btnReportar").addClass("disabled");
    });
    $("#btnReportar").click(function()
    { 
        enviarReporte();
    });
    $("#pubComentario").keyup(function(){
        if($(this).val() != "")
            $("#btnCrearComentario").removeClass("disabled");
        else
            $("#btnCrearComentario").addClass("disabled");
    });
    $("#btnCrearComentario").click(function()
    {
        if($("#pubComentario").val() != "")
            enviarComentario();
        //alert(idUsuario + "." + idPublicacion);
    });
    $("#btnMensaje").click(function()
    {
        enviarReclamo();
    });
    $("#pubComentario").keypress(function(e) {
        if(e.which == 13) {
         if($("#pubComentario").val() != "")
            enviarComentario();
        }
      });
    function enviarReporte()
    {

        var idPublicacion = $("#idPublicacion").val();
        var idRazonReporte = $("#idRazonReporte").find(":selected").val();
        var token = '{{csrf_token()}}';
        var data = {
                    idRazonReporte:idRazonReporte, 
                    idPublicacion:idPublicacion,
                    _token:token
                };
        
      $.ajax({
        url: '/razonReporte',
        async: 'true',
        type: 'POST',
        data: data,
        success: function (respuesta) {
            $("#reportarPublicacion").addClass("disabled");
            $("#msgReporteTitle").html("Reporte realizado correctamente");
          $("#msgReporte").modal('open');
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);

        }

        });
    }

    function enviarComentario()
    {
        
        var idPublicacion = {{$publicacionData->getIdPublicacion()}};
        var comentario = $("#pubComentario").val();
        var token = '{{csrf_token()}}';
        var data = {
                    idPublicacion:idPublicacion,
                    comentario:comentario,
                    _token:token
                };
        
      $.ajax({
        url: '/comentario',
        async: 'true',
        type: 'POST',
        data: data,
        success: function (respuesta) {
            $("#pubComentario").val("");
            $("#btnCrearComentario").addClass("disabled");
          $("#msgReporteTitle").html("Comentario realizado correctamente");
          $("#msgReporte").modal('open');
          getComentarios();
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);

        }

        });
    }
    function enviarReclamo()
    {

        var idPublicacion = {{$publicacionData->getIdPublicacion()}};
        var mensaje = $("#txtContactar").val();
        var token = '{{csrf_token()}}';
        var data = {
                    idPublicacion:idPublicacion,
                    descripcion:mensaje,
                    _token:token,
                    ajax:true
                };
      $.ajax({
        url: '/reclamo',
        async: 'true',
        type: 'POST',
        data: data,
        success: function (respuesta) {
            $("#reclamarObjeto").html("<i class='material-icons right'>check</i> Objeto reclamado");
            
            $("#reclamarObjeto").addClass("disabled");
            $("#msgReporteTitle").html("Reclamo realizado correctamente");
            $("#msgReporte").modal('open');
            
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);

        }

        });
    }
    getComentarios();
    function getComentarios()
    {
      $.ajax({
        url: "{{url('/data/comments?id='.$publicacionData->getIdPublicacion())}}",
        async: 'true',
        type: 'GET',
        dataType: 'json',

        success: function (respuesta) {
            
           // debugger;
           $("#commentList").html("");
        for(var i = 0; i < respuesta.length; i++)
        {             
              var cardInfo = 
              "<div class='card row card-panel z-depth-1'>" +
                    "<div class='col s12'>" +
                        "<div class=' z-depth-0'>" +
                            "<div class='row valign-wrapper'>" +
                                "<div class='col s2'>" +
                                    "<img src="+respuesta[i].pathImagen+" alt='' class='circle responsive-img'> <!-- notice the 'circle' class -->" +
                                "</div>" +
                                "<div class='col s10'>" +
                                    "<div  class='black-text'>" +
                                    "<a href='/profile/"+respuesta[i].idUsuario+"'><strong>" + respuesta[i].name +"</strong></a> - " + respuesta[i].antiguedad  +
                                    "</div>" +
                                    "<div class='input-field col l12 s12'>" +
                                            respuesta[i].comentario +
                                    "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>" +
                "</div>";

                $("#commentList").append(cardInfo);
          } 
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);

        }

        });
    }

    getPuntuacion();
    function getPuntuacion()
    {
      $.ajax({
        url: "{{url('/puntuacion-total?id='.$publicacionData->getIdUsuario())}}",
        async: 'true',
        type: 'GET',
        dataType: 'json',

        success: function (respuesta) {
            //debugger;
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

